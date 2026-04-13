<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use PlatinumPlace\LaravelDgii\Clients\DgiiClient;
use PlatinumPlace\LaravelDgii\Helpers\StorageHelper;
use PlatinumPlace\LaravelDgii\Services\SignXmlService;

class SendInvoiceToDgiiAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected AuthenticateWithDgiiAction $authenticateWithDgiiAction,
        protected DgiiClient                 $client,
        protected StorageHelper              $storageHelper
    )
    {
        //
    }

    public function handle(?string $env = null, ?string $certPath = null, ?string $certPassword = null): array
    {
        $token = $this->authenticateWithDgiiAction->handle($env, $certPath, $certPassword);
    }
}