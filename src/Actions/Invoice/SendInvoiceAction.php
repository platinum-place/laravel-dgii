<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoice;

use PlatinumPlace\LaravelDgii\Actions\AuthenticateAction;
use PlatinumPlace\LaravelDgii\Clients\ConsumeInvoiceClient;
use PlatinumPlace\LaravelDgii\Clients\InvoiceClient;
use PlatinumPlace\LaravelDgii\Data\InvoiceData;
use PlatinumPlace\LaravelDgii\Support\StorageService;
use PlatinumPlace\LaravelDgii\Traits\Invoices\HasResponse;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceReceived;

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
     * @param  InvoiceData  $invoiceData  The stored invoice object.
     * @param  string|null  $env  The environment to use.
     * @param  string|null  $certPath  Optional certificate path for authentication.
     * @param  string|null  $certPassword  Optional certificate password.
     * @param  string|null  $token  Optional existing authentication token.
     * @return InvoiceReceived The wrapped DGII response.
     */
    public function handle(InvoiceData $invoiceData, ?string $env = null, ?string $certPath = null, ?string $certPassword = null, ?string $token = null): InvoiceReceived
    {
        return $this->catchResponse(function () use ($invoiceData, $env, $certPath, $certPassword, $token) {
            if (! $token) {
                $token = $this->authenticateAction->handle($env, $certPath, $certPassword);
            }

            return $invoiceData->invoiceXml->isConsumeInvoice()
                ? $this->consumeInvoiceClient->send($token, $invoiceData->invoiceXmlPath, $env)
                : $this->invoiceClient->send($token, $invoiceData->invoiceXmlPath, $env);
        });
    }
}
