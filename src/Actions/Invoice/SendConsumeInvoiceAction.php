<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoice;

use PlatinumPlace\LaravelDgii\Actions\AuthenticateAction;
use PlatinumPlace\LaravelDgii\Actions\WrapDgiiResponseAction;
use PlatinumPlace\LaravelDgii\Clients\ConsumeInvoiceClient;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceReceived;

/**
 * Action specialized in sending consumer summaries (RFCE) to DGII.
 */
class SendConsumeInvoiceAction
{
    /**
     * Create a new action instance.
     */
    public function __construct(
        protected WrapDgiiResponseAction $wrapDgiiResponseAction,
        protected AuthenticateAction $authenticateAction,
        protected ConsumeInvoiceClient $consumeInvoiceClient,
    ) {
        //
    }

    /**
     * Send the consumer summary using the specialized client.
     *
     * @param  string  $filePath  Full path to the XML file.
     * @param  string|null  $env  The environment to use.
     * @param  string|null  $certPath  Optional certificate path.
     * @param  string|null  $certPassword  Optional certificate password.
     * @return InvoiceReceived The response from DGII.
     */
    public function handle(string $filePath, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceReceived
    {
        [$response, $status] = $this->wrapDgiiResponseAction->handle(function () use ($filePath, $env, $certPath, $certPassword) {
            $token = $this->authenticateAction->handle($env, $certPath, $certPassword);

            return $this->consumeInvoiceClient->send($token, $filePath, $env);
        });

        return new InvoiceReceived($response, $status);
    }
}
