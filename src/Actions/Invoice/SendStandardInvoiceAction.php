<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoice;

use PlatinumPlace\LaravelDgii\Actions\AuthenticateAction;
use PlatinumPlace\LaravelDgii\Actions\WrapDgiiResponseAction;
use PlatinumPlace\LaravelDgii\Clients\InvoiceClient;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceReceived;

/**
 * Action specialized in sending standard electronic invoices to DGII.
 */
class SendStandardInvoiceAction
{
    /**
     * Create a new action instance.
     */
    public function __construct(
        protected WrapDgiiResponseAction $wrapDgiiResponseAction,
        protected AuthenticateAction $authenticateAction,
        protected InvoiceClient $invoiceClient,
    ) {
        //
    }

    /**
     * Send the invoice using the standard client.
     *
     * @param  string  $filePath  Full path to the XML file.
     * @param  string|null  $env  The environment to use.
     * @param  string|null  $certPath  Optional certificate path.
     * @param  string|null  $certPassword  Optional certificate password.
     * @param  string|null  $token  Authentication token.
     */
    public function handle(string $filePath, ?string $env = null, ?string $certPath = null, ?string $certPassword = null, ?string $token = null): InvoiceReceived
    {
        [$response, $status] = $this->wrapDgiiResponseAction->handle(function () use ($token, $filePath, $env, $certPath, $certPassword) {
            if (! $token) {
                $token = $this->authenticateAction->handle($env, $certPath, $certPassword);
            }

            return $this->invoiceClient->send($token, $filePath, $env);
        });

        return new InvoiceReceived($response, $status);
    }
}
