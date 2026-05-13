<?php

namespace PlatinumPlace\LaravelDgii\Actions\Xmls\Orchestrators;

use PlatinumPlace\DgiiXmlSigner\SignManager;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;

/**
 * Handles the digital signature of XML documents.
 */
class SignXmlAction
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
     * Sign an XML string using a digital certificate.
     *
     * Flow:
     * 1. Resolve certificate path and password from config if not provided.
     * 2. Verify certificate existence in storage.
     * 3. Load certificate content.
     * 4. Use SignManager to apply the digital signature to the XML.
     *
     * @throws \InvalidArgumentException
     */
    public function handle(string $xml, ?string $certPath = null, ?string $certPassword = null): string
    {
        $certPath = $certPath ?? config('dgii.certificate');

        $this->storage->ifExists($certPath);

        $certContent = $this->storage->get($certPath);

        $certPassword = $certPassword ?? config('dgii.certificate_password');

        return (new SignManager)->sign($certContent, $certPassword, $xml);
    }
}
