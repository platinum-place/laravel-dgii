<?php

namespace PlatinumPlace\LaravelDgii\Actions\CancellationRange;

use PlatinumPlace\LaravelDgii\Support\XmlSigner;
use PlatinumPlace\LaravelDgii\ValueObjects\CancellationRange\CancellationRangeXml;

class SignCancellationRangeAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected XmlSigner $xmlSigner)
    {
        //
    }

    public function handle(string $cancellationRangeXmlContent, ?string $certPath = null, ?string $certPassword = null): CancellationRangeXml
    {
        $signedXml = $this->xmlSigner->sign($cancellationRangeXmlContent, $certPath, $certPassword);

        return new CancellationRangeXml($signedXml);
    }
}
