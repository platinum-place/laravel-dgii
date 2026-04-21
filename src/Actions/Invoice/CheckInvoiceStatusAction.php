<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoice;

use PlatinumPlace\LaravelDgii\Actions\AuthenticateAction;
use PlatinumPlace\LaravelDgii\Clients\ConsumeInvoiceClient;
use PlatinumPlace\LaravelDgii\Clients\InvoiceClient;
use PlatinumPlace\LaravelDgii\Support\StorageService;
use PlatinumPlace\LaravelDgii\Traits\Invoices\HasResponse;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceReceived;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceXml;

/**
 * Action to check the status of a previously sent e-CF.
 */
class CheckInvoiceStatusAction
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
     * Query DGII for the status of a previously sent e-CF.
     *
     * @param  string  $xmlPath  Relative path of the XML file in storage.
     * @param  string|null  $trackId  Tracking ID returned by DGII upon submission.
     * @param  string|null  $env  The environment to use.
     * @param  string|null  $certPath  Optional certificate path for authentication.
     * @param  string|null  $certPassword  Optional certificate password.
     * @return InvoiceReceived Response containing the detailed invoice status.
     */
    public function handle(string $xmlPath, ?string $trackId = null, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceReceived
    {
        $invoiceXml = InvoiceXml::fromXmlPath($xmlPath);

        return $this->catchResponse(function () use ($env, $certPath, $certPassword, $invoiceXml, $trackId) {
            $token = $this->authenticateAction->handle($env, $certPath, $certPassword);

            return $invoiceXml->isConsumeInvoice()
                ? $this->consumeInvoiceClient->fetchStatus($token, $invoiceXml, $env)
                : $this->invoiceClient->fetchStatusByTrackId($token, $trackId, $env);
        });
    }
}
