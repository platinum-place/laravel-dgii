<?php

namespace PlatinumPlace\LaravelDgii\Actions\CancellationRange;

use PlatinumPlace\LaravelDgii\Support\XmlSigner;
use PlatinumPlace\LaravelDgii\ValueObjects\CancellationRange\CancellationRangeXml;

/**
 * Action to digitally sign a Cancellation Range (ANECF) XML.
 */
class SignCancellationRangeAction
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
     * Sign the Cancellation Range XML content.
     *
     * @param string $cancellationRangeXmlContent Raw XML content to sign.
     * @param string|null $certPath Optional certificate path.
     * @param string|null $certPassword Optional certificate password.
     * @return CancellationRangeXml The signed Cancellation Range value object.
     */
    public function handle(string $cancellationRangeXmlContent, ?string $certPath = null, ?string $certPassword = null): CancellationRangeXml
    {
        $signedXml = $this->xmlSigner->sign($cancellationRangeXmlContent, $certPath, $certPassword);

        return new CancellationRangeXml($signedXml);
    }
}
