<?php

namespace PlatinumPlace\LaravelDgii\Support;

use PlatinumPlace\DgiiXmlSigner\SignManager;

/**
 * Service to handle XML digital signing.
 */
class XmlSigner
{
    /**
     * Create a new XML signer instance.
     *
     * @param StorageService $storageService Storage service instance.
     */
    public function __construct(protected StorageService $storageService)
    {
        //
    }

    /**
     * Digitally sign XML content using the configured certificate.
     *
     * @param string $xml Raw XML content to be signed.
     * @param string|null $certPath Path to the certificate in storage.
     * @param string|null $certPassword The certificate password.
     * @return string The digitally signed XML content.
     */
    public function sign(string $xml, ?string $certPath = null, ?string $certPassword = null): string
    {
        return (new SignManager)->sign(
            $this->storageService->get($certPath ?? config('dgii.certificate')),
            $certPassword ?? config('dgii.certificate_password'),
            $xml
        );
    }
}
