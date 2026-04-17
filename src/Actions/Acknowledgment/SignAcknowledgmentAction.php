<?php

namespace PlatinumPlace\LaravelDgii\Actions\Acknowledgment;

use PlatinumPlace\LaravelDgii\Support\XmlSigner;
use PlatinumPlace\LaravelDgii\ValueObjects\Acknowledgment\AcknowledgmentXml;

class SignAcknowledgmentAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected XmlSigner $xmlSigner)
    {
        //
    }

    public function handle(string $acknowledgmentXmlContent, ?string $certPath = null, ?string $certPassword = null): AcknowledgmentXml
    {
        $signedAcknowledgment = $this->xmlSigner->sign($acknowledgmentXmlContent, $certPath, $certPassword);

        return new AcknowledgmentXml($signedAcknowledgment);
    }
}
