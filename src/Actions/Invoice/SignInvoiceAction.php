<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoice;

use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\Support\XmlSigner;

/**
 * Action to digitally sign generated Invoice XMLs.
 */
class SignInvoiceAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected XmlSigner $xmlSigner,
        protected GenerateConsumeInvoiceAction $generateConsumeInvoiceAction
    ) {}

    /**
     * Sign the generated invoice XML(s) using digital signatures.
     *
     * @param string $xmlContent Main e-CF XML content.
     * @param array $data Additional data for invoice generation.
     * @param string|null $certPath Optional certificate path.
     * @param string|null $certPassword Optional certificate password.
     * @return array A signed XML.
     * @throws \Exception
     */
    public function handle(string $xmlContent, array $data, ?string $certPath = null, ?string $certPassword = null): array
    {
        $invoiceXmlSigned = $this->xmlSigner->sign($xmlContent, $certPath, $certPassword);

        $invoiceXml = new InvoiceXml($invoiceXmlSigned);

        $integralInvoiceXml = null;

        if ($invoiceXml->isConsumeInvoice()) {
            $integralInvoiceXml = $invoiceXml;

            $invoiceXmlContent = $this->generateConsumeInvoiceAction->handle($invoiceXml, $data);

            $invoiceXmlSigned = $this->xmlSigner->sign($invoiceXmlContent, $certPath, $certPassword);

            $invoiceXml = new InvoiceXml($invoiceXmlSigned);
        }

        return [$invoiceXml, $integralInvoiceXml];
    }
}
