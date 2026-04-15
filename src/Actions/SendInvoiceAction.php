<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use PlatinumPlace\LaravelDgii\Clients\DgiiClient;
use PlatinumPlace\LaravelDgii\Helpers\StorageHelper;
use PlatinumPlace\LaravelDgii\ValueObjects\InvoiceXml;

class SendInvoiceAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected AuthenticateAction $authenticateAction,
        protected DgiiClient $client,
        protected StorageHelper $storageHelper
    ) {
        //
    }

    /**
     * @throws ConnectionException
     * @throws RequestException
     */
    public function handle(string $xmlPath, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): array
    {
        $token = $this->authenticateAction->handle($env, $certPath, $certPassword);

        $xml = $this->storageHelper->get($xmlPath);

        $invoiceXml = new InvoiceXml($xml);

        return $invoiceXml->isConsumeInvoice()
            ? $this->client->sendConsumerInvoice($token, $xmlPath, $env)
            : $this->client->sendInvoice($token, $xmlPath, $env);
    }
}
