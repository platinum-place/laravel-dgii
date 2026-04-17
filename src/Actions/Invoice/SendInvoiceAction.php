<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoice;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use PlatinumPlace\LaravelDgii\Actions\AuthenticateAction;
use PlatinumPlace\LaravelDgii\Clients\ConsumeInvoiceClient;
use PlatinumPlace\LaravelDgii\Clients\InvoiceClient;
use PlatinumPlace\LaravelDgii\Support\StorageService;
use PlatinumPlace\LaravelDgii\Traits\Invoices\HasResponse;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceReceived;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\StoredInvoice;

class SendInvoiceAction
{
    use HasResponse;

    /**
     * Create a new class instance.
     */
    public function __construct(
        protected AuthenticateAction   $authenticateAction,
        protected StorageService       $storageService,
        protected InvoiceClient        $invoiceClient,
        protected ConsumeInvoiceClient $consumeInvoiceClient,
    )
    {
        //
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function handle(StoredInvoice $storedInvoice, ?string $env = null, ?string $certPath = null, ?string $certPassword = null, ?string $token = null): InvoiceReceived
    {
        if (!$token) {
            $token = $this->authenticateAction->handle($env, $certPath, $certPassword);
        }

        return $this->catchResponse(
            fn() => $storedInvoice->signedInvoice->invoiceXml->isConsumeInvoice()
                ? $this->consumeInvoiceClient->send($token, $storedInvoice->invoiceXmlPath, $env)
                : $this->invoiceClient->send($token, $storedInvoice->invoiceXmlPath, $env)
        );
    }
}
