<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use PlatinumPlace\LaravelDgii\Clients\DgiiClient;
use PlatinumPlace\LaravelDgii\DgiiXmlHelper;
use PlatinumPlace\LaravelDgii\Helpers\StorageHelper;
use PlatinumPlace\LaravelDgii\Services\SignXmlService;
use PlatinumPlace\LaravelDgii\ValueObjects\InvoiceValueObject;

class SendInvoiceAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected AuthenticateAction $authenticateAction,
        protected DgiiClient         $client,
        protected StorageHelper      $storageHelper
    )
    {
        //
    }

    /**
     * @throws ConnectionException
     * @throws RequestException
     */
    public function handle(string $filePath, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): array
    {
        $token = $this->authenticateAction->handle($env, $certPath, $certPassword);

        $xmlPath = $this->storageHelper->path($filePath);

        $invoiceObject = new InvoiceValueObject($this->storageHelper->get($xmlPath));

        return $invoiceObject->isConsumeInvoice()
            ? $this->client->sendConsumerInvoice($token, $xmlPath, $env)
            : $this->client->sendInvoice($token, $xmlPath, $env);
    }
}