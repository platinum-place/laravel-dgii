<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoice;

use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\Data\Invoice\SignedInvoice;
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
        protected GenerateInvoiceAction $generateInvoiceAction,
        protected XmlSigner $xmlSigner,
        protected GenerateConsumeInvoiceAction $generateConsumeInvoiceAction
    ) {
        //
    }

    public function handle(array $data, ?string $certPath = null, ?string $certPassword = null): SignedInvoice
    {
        $invoiceXmlContent = $this->generateInvoiceAction->handle($data);

        $invoiceXmlSigned = $this->xmlSigner->sign($invoiceXmlContent, $certPath, $certPassword);

        $invoiceXml = new InvoiceXml($invoiceXmlSigned);

        $integralInvoiceXml = null;

        if ($invoiceXml->isConsumeInvoice()) {
            $integralInvoiceXml = $invoiceXml;

            $invoiceXmlContent = $this->generateConsumeInvoiceAction->handle($invoiceXml, $data);

            $invoiceXmlSigned = $this->xmlSigner->sign($invoiceXmlContent, $certPath, $certPassword);

            $invoiceXml = new InvoiceXml($invoiceXmlSigned);
        }

        return new SignedInvoice($invoiceXml, $integralInvoiceXml);
    }
}
