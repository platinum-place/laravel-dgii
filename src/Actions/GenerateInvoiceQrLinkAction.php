<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use PlatinumPlace\LaravelDgii\Clients\DgiiClient;
use PlatinumPlace\LaravelDgii\Helpers\StorageHelper;
use PlatinumPlace\LaravelDgii\ValueObjects\InvoiceXml;

class GenerateInvoiceQrLinkAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected DgiiClient $client, protected StorageHelper $storageHelper)
    {
        //
    }

    public function handle(string $xmlPath, ?string $env = null): string
    {
        $xml = $this->storageHelper->get($xmlPath);

        $invoiceXml = new InvoiceXml($xml);

        return $invoiceXml->isConsumeInvoice()
            ? $this->client->fetchConsumerInvoiceQRLink($invoiceXml, $env)
            : $this->client->fetchInvoiceQRLink($invoiceXml, $env);
    }
}
