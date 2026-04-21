<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use PlatinumPlace\DgiiXmlSigner\Exception\DgiiXmlSignerException;
use PlatinumPlace\LaravelDgii\Support\XmlSigner;

/**
 * Action to validate the digital certificate configuration.
 *
 * It ensures the certificate exists in storage and the provided
 * password is correct before attempting any signing operation.
 */
class ValidateCertAction
{
    /**
     * Create a new validate certificate action instance.
     *
     * @param  XmlSigner  $xmlSigner  XML signing service.
     */
    public function __construct(protected XmlSigner $xmlSigner)
    {
        //
    }

    /**
     * Validate the certificate and its password.
     *
     * @param  string|null  $certPath  Optional certificate path.
     * @param  string|null  $certPassword  Optional certificate password.
     * @return array The parsed certificate data.
     *
     * @throws DgiiXmlSignerException
     */
    public function handle(?string $certPath = null, ?string $certPassword = null): array
    {
        return $this->xmlSigner->validateCertificate($certPath, $certPassword);
    }
}
