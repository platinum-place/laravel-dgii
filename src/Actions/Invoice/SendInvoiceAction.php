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
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\StoredInvoice;

/**
 * Action to send a signed and stored e-CF to DGII.
 */
class SendInvoiceAction
{
    use HasResponse;

    /**
     * Create a new class instance.
     *
     * @param  AuthenticateAction  $authenticateAction  Authentication service.
     * @param  StorageService  $storageService  Storage service instance.
     * @param  InvoiceClient  $invoiceClient  Standard e-CF client.
     * @param  ConsumeInvoiceClient  $consumeInvoiceClient  Consumption invoice client.
     */
    public function __construct(
        protected AuthenticateAction $authenticateAction,
        protected StorageService $storageService,
        protected InvoiceClient $invoiceClient,
        protected ConsumeInvoiceClient $consumeInvoiceClient,
    ) {
        //
    }

    /**
     * Send the stored invoice to DGII and capture the response.
     *
     * @param  StoredInvoice  $storedInvoice  The stored invoice object.
     * @param  string|null  $env  The environment to use.
     * @param  string|null  $certPath  Optional certificate path for authentication.
     * @param  string|null  $certPassword  Optional certificate password.
     * @param  string|null  $token  Optional existing authentication token.
     * @return InvoiceReceived The wrapped DGII response.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function handle(StoredInvoice $storedInvoice, ?string $env = null, ?string $certPath = null, ?string $certPassword = null, ?string $token = null): InvoiceReceived
    {
        return $this->catchResponse(function () use ($storedInvoice, $env, $certPath, $certPassword, $token) {
            if (! $token) {
                $token = $this->authenticateAction->handle($env, $certPath, $certPassword);
            }

            return $storedInvoice->signedInvoice->invoiceXml->isConsumeInvoice()
                ? $this->consumeInvoiceClient->send($token, $storedInvoice->invoiceXmlPath, $env)
                : $this->invoiceClient->send($token, $storedInvoice->invoiceXmlPath, $env);
        });
    }
}
