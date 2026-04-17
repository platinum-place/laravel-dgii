<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoice;

use PlatinumPlace\LaravelDgii\Support\XmlSigner;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceGenerated;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\SignedInvoice;

class SignInvoiceAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected XmlSigner $xmlSigner,
        protected GenerateInvoiceQrLinkAction $generateInvoiceQrLinkAction,
    ) {
        //
    }

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
