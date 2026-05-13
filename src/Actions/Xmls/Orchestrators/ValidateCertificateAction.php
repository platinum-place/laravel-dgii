<?php

namespace PlatinumPlace\LaravelDgii\Actions\Xmls\Orchestrators;

use PlatinumPlace\DgiiXmlSigner\SignManager;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;

/**
 * Orchestrates the validation of a digital certificate (.p12).
 */
class ValidateCertificateAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected StorageRepository $storage,
    ) {
        //
    }

    /**
     * Verify the existence and integrity of the digital certificate.
     *
     * Flow:
     * 1. Resolve certificate path and password from config if not provided.
     * 2. Verify certificate existence in storage.
     * 3. Load certificate content.
     * 4. Use SignManager to validate the certificate and password.
     */
    public function handle(?string $path = null, ?string $password = null): array
    {
        $path = $path ?? config('dgii.certificate');

        $this->storage->ifExists($path);

        $content = $this->storage->get($path);

        $password = $password ?? config('dgii.certificate_password');

        return (new SignManager)->validateCertificate($content, $password);
    }
}
