<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoice;

use PlatinumPlace\LaravelDgii\Support\XmlSigner;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceGenerated;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\SignedInvoice;

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
     * Sign the generated invoice XML(s) and generate the QR verification link.
     *
     * @param  InvoiceGenerated  $invoiceGenerated  Generated XML object.
     * @param  string|null  $env  The environment to use.
     * @param  string|null  $certPath  Optional certificate path.
     * @param  string|null  $certPassword  Optional certificate password.
     * @return SignedInvoice The signed invoice object.
     */
    public function handle(InvoiceGenerated $invoiceGenerated, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): SignedInvoice
    {
        $signedXml = $this->xmlSigner->sign($invoiceGenerated->invoiceXml->xmlContent, $certPath, $certPassword);

        $invoiceXml = new InvoiceXml($signedXml);

        $integralInvoiceXml = null;

        if ($invoiceGenerated->integralInvoiceXml) {
            $signedXml = $this->xmlSigner->sign($invoiceGenerated->integralInvoiceXml->xmlContent, $certPath, $certPassword);

            $integralInvoiceXml = new InvoiceXml($signedXml);
        }

        return new SignedInvoice(
            $invoiceXml,
            $this->generateInvoiceQrLinkAction->handle($invoiceXml, $env),
            $integralInvoiceXml,
        );
    }
}
