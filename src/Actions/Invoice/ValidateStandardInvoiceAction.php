<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoice;

use PlatinumPlace\LaravelDgii\Actions\AuthenticateAction;
use PlatinumPlace\LaravelDgii\Actions\WrapDgiiResponseAction;
use PlatinumPlace\LaravelDgii\Clients\InvoiceClient;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceReceived;

/**
 * Action specialized in validating/fetching status of standard electronic invoices from DGII.
 */
class ValidateStandardInvoiceAction
{
    /**
     * Create a new action instance.
     */
    public function __construct(
        protected InvoiceClient $invoiceClient,
        protected WrapDgiiResponseAction $wrapDgiiResponseAction,
        protected AuthenticateAction $authenticateAction,
    ) {
        //
    }

    /**
     * Fetch the invoice status using the standard client.
     *
     * @param  string  $trackId  The tracking ID returned during submission.
     * @param  string|null  $env  The environment to use.
     * @param  string|null  $certPath  Optional certificate path.
     * @param  string|null  $certPassword  Optional certificate password.
     * @param  string|null  $token  Authentication token.
     * @return InvoiceReceived The response from DGII.
     */
    public function handle(string $trackId, ?string $env = null, ?string $certPath = null, ?string $certPassword = null, ?string $token = null): InvoiceReceived
    {
        [$response, $status] = $this->wrapDgiiResponseAction->handle(function () use ($token, $trackId, $env, $certPath, $certPassword) {
            if (! $token) {
                $token = $this->authenticateAction->handle($env, $certPath, $certPassword);
            }

            return $this->invoiceClient->fetchStatusByTrackId($token, $trackId, $env);
        });

        return new InvoiceReceived($response, $status);
    }
}
