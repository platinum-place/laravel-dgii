<?php

namespace PlatinumPlace\LaravelDgii\Actions\Xmls\Orchestrators;

use PlatinumPlace\DgiiXmlSigner\SignManager;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;

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

    public function handle(string $xml, ?string $certPath = null, ?string $certPassword = null): string
    {
        $certPath = $certPath ?? config('dgii.certificate');

        $this->storage->ifExists($certPath);

        $certContent = $this->storage->get($certPath);

        $certPassword = $certPassword ?? config('dgii.certificate_password');

        return (new SignManager)->sign($certContent, $certPassword, $xml);
    }
}
