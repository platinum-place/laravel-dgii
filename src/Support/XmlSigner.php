<?php

namespace PlatinumPlace\LaravelDgii\Support;

use PlatinumPlace\DgiiXmlSigner\Exception\DgiiXmlSignerException;
use PlatinumPlace\DgiiXmlSigner\SignManager;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;

/**
 * Service to handle XML digital signing.
 */
class XmlSigner
{
    /**
     * Create a new XML signer instance.
     *
     * @param  StorageRepository  $storageService  Storage service instance.
     */
    public function __construct(protected StorageRepository $storageService)
    {
        //
    }

    /**
     * Digitally sign XML content using the configured certificate.
     *
     * @param  string  $xml  Raw XML content to be signed.
     * @param  string|null  $certPath  Path to the certificate in storage.
     * @param  string|null  $certPassword  The certificate password.
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

    /**
     * Validate the certificate and its password.
     *
     * @param  string|null  $certPath  Path to the certificate in storage.
     * @param  string|null  $certPassword  The certificate password.
     * @return array The parsed certificate data.
     *
     * @throws DgiiXmlSignerException
     */
    public function validateCertificate(?string $certPath = null, ?string $certPassword = null): array
    {
        return (new SignManager)->validateCertificate(
            $this->storageService->get($certPath ?? config('dgii.certificate')),
            $certPassword ?? config('dgii.certificate_password')
        );
    }
}
