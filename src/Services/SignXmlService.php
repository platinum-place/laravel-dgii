<?php

namespace PlatinumPlace\LaravelDgii\Services;

use Illuminate\Support\Facades\Storage;
use PlatinumPlace\DgiiXmlSigner\SignManager;
use PlatinumPlace\LaravelDgii\Helpers\StorageHelper;

class SignXmlService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected StorageHelper $storageHelper)
    {
        //
    }

    public function handle(string $xml, ?string $certPath = null, ?string $certPassword = null): string
    {
        return (new SignManager)->sing(
            $this->storageHelper->get($certPath ?? config('dgii.certificate')),
            $certPassword ?? config('dgii.certificate_password'),
            $xml
        );
    }
}
