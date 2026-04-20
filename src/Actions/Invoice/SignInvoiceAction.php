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
     * @param string $xmlContent Main e-CF XML content.
     * @param string|null $certPath Optional certificate path.
     * @param string|null $certPassword Optional certificate password.
     * @return InvoiceXml A signed XML.
     */
    public function handle(string $xmlContent,?string $certPath = null, ?string $certPassword = null): InvoiceXml
    {
        $signedXml = $this->xmlSigner->sign($xmlContent, $certPath, $certPassword);

        return new InvoiceXml($signedXml);
    }
}
