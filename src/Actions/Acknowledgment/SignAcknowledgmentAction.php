<?php

namespace PlatinumPlace\LaravelDgii\Actions\Acknowledgment;

use PlatinumPlace\LaravelDgii\Support\XmlSigner;
use PlatinumPlace\LaravelDgii\ValueObjects\Acknowledgment\AcknowledgmentXml;

/**
 * Action to digitally sign an Acknowledgment (Acuse de Recibo) XML.
 */
class SignAcknowledgmentAction
{
    /**
     * Create a new class instance.
     *
     * @param XmlSigner $xmlSigner XML signing service.
     */
    public function __construct(protected XmlSigner $xmlSigner)
    {
        //
    }

    /**
     * Sign the Acknowledgment XML content.
     *
     * @param string $acknowledgmentXmlContent Raw XML content to sign.
     * @param string|null $certPath Optional certificate path.
     * @param string|null $certPassword Optional certificate password.
     * @return AcknowledgmentXml The signed Acknowledgment value object.
     */
    public function handle(string $acknowledgmentXmlContent, ?string $certPath = null, ?string $certPassword = null): AcknowledgmentXml
    {
        $signedAcknowledgment = $this->xmlSigner->sign($acknowledgmentXmlContent, $certPath, $certPassword);

        return new AcknowledgmentXml($signedAcknowledgment);
    }
}
