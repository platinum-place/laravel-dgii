<?php

namespace PlatinumPlace\LaravelDgii\Services;

use PlatinumPlace\DgiiXmlSigner\Exception\DgiiXmlSignerException;
use PlatinumPlace\DgiiXmlSigner\SignManager;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;

/**
 * Service to handle XML digital signing and certificate validation.
 *
 * This service provides a high-level interface for applying digital signatures
 * to XML documents using X509 certificates, as required by the DGII for e-CF.
 */
class XmlSigner
{
    /**
     * Create a new XML signer instance.
     *
     * @param  StorageRepository  $storageRepository  Repository used to retrieve certificate files from storage.
     */
    public function __construct(protected StorageRepository $storageRepository)
    {
        //
    }

    /**
     * Digitally sign XML content using the configured certificate.
     *
     * Flow: Load certificate -> Initialize SignManager -> Apply signature to XML -> Return signed XML string.
     *
     * @param  string  $xml  Raw XML content to be signed.
     * @param  string|null  $certPath  Path to the certificate (relative to configured storage). Defaults to config('dgii.certificate').
     * @param  string|null  $certPassword  The password for the certificate. Defaults to config('dgii.certificate_password').
     * @return string The digitally signed XML content.
     */
    public function sign(string $xml, ?string $certPath = null, ?string $certPassword = null): string
    {
        return (new SignManager)->sign(
            $this->storageRepository->get($certPath ?? config('dgii.certificate')),
            $certPassword ?? config('dgii.certificate_password'),
            $xml
        );
    }

    /**
     * Validate a certificate file and its password.
     *
     * Flow: Load certificate -> Parse certificate data -> Verify password validity -> Return certificate details.
     *
     * @param  string|null  $certPath  Path to the certificate. Defaults to config.
     * @param  string|null  $certPassword  The certificate password. Defaults to config.
     * @return array The parsed certificate data (e.g., subject, issuer, valid dates).
     *
     * @throws DgiiXmlSignerException If the certificate is invalid or the password is incorrect.
     */
    public function validateCertificate(?string $certPath = null, ?string $certPassword = null): array
    {
        return (new SignManager)->validateCertificate(
            $this->storageRepository->get($certPath ?? config('dgii.certificate')),
            $certPassword ?? config('dgii.certificate_password')
        );
    }
}
