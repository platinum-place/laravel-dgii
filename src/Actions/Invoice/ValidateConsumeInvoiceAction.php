<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoice;

use PlatinumPlace\LaravelDgii\Actions\AuthenticateAction;
use PlatinumPlace\LaravelDgii\Actions\WrapDgiiResponseAction;
use PlatinumPlace\LaravelDgii\Clients\ConsumeInvoiceClient;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceReceived;

/**
 * Action specialized in validating/fetching status of consumer summaries (RFCE) from DGII.
 */
class ValidateConsumeInvoiceAction
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
     * Fetch the consumer summary status using the specialized client.
     *
     * @param  string  $senderIdentification  Sender identification number.
     * @param  string  $sequenceNumber  Electronic NCF (Sequence number).
     * @param  string  $securityCode  Security code of the invoice.
     * @param  string|null  $env  The environment to use.
     * @param  string|null  $certPath  Optional certificate path.
     * @param  string|null  $certPassword  Optional certificate password.
     * @return InvoiceReceived The response from DGII.
     */
    public function handle(string $senderIdentification, string $sequenceNumber, string $securityCode, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceReceived
    {
        [$response, $status] = $this->wrapDgiiResponseAction->handle(function () use ($senderIdentification, $sequenceNumber, $securityCode, $env, $certPath, $certPassword) {
            $token = $this->authenticateAction->handle($env, $certPath, $certPassword);

            return $this->consumeInvoiceClient->fetchStatus(
                $token,
                $senderIdentification,
                $sequenceNumber,
                $securityCode,
                $env
            );
        });

        return new InvoiceReceived($response, $status);
    }
}
