<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoice;

use PlatinumPlace\LaravelDgii\Support\XmlSigner;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceXml;

/**
 * Action to digitally sign generated Invoice XMLs.
 */
class SignInvoiceAction
{
    /**
     * Create a new class instance.
     *
     * @param  XmlSigner  $xmlSigner  XML signing service.
     * @param  GenerateInvoiceQrLinkAction  $generateInvoiceQrLinkAction  QR link generation service.
     */
    public function __construct(
        protected XmlSigner $xmlSigner,
        protected GenerateInvoiceQrLinkAction $generateInvoiceQrLinkAction,
    ) {
        //
    }

    /**
     * Sign the generated invoice XML(s) using digital signatures.
     *
     * @param  InvoiceXml  $invoiceXml  Main e-CF XML object.
     * @param  string|null  $env  The environment to use.
     * @param  string|null  $certPath  Optional certificate path.
     * @param  string|null  $certPassword  Optional certificate password.
     * @param  InvoiceXml|null  $integralInvoiceXml  Optional integral invoice (e-CF part of consumer summary).
     * @return array An array containing [InvoiceXml, ?InvoiceXml] (signed XMLs).
     */
    public function handle(InvoiceXml $invoiceXml, ?string $env = null, ?string $certPath = null, ?string $certPassword = null, ?InvoiceXml $integralInvoiceXml = null): array
    {
        $signedXml = $this->xmlSigner->sign($invoiceXml->xmlContent, $certPath, $certPassword);

        $invoiceXml = new InvoiceXml($signedXml);

        if ($integralInvoiceXml) {
            $signedXml = $this->xmlSigner->sign($integralInvoiceXml->xmlContent, $certPath, $certPassword);

            $integralInvoiceXml = new InvoiceXml($signedXml);
        }

        return [$invoiceXml, $integralInvoiceXml];
    }
}
