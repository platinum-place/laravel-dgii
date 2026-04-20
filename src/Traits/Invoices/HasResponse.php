<?php

namespace PlatinumPlace\LaravelDgii\Traits\Invoices;

use PlatinumPlace\LaravelDgii\Traits\HandlesDgiiResponse;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceReceived;

/**
 * Trait to handle and wrap HTTP responses from DGII.
 */
trait HasResponse
{
    use HandlesDgiiResponse;

    /**
     * Execute a callback and wrap its response into an InvoiceReceived object.
     * Handles RequestException to capture error responses from the API.
     *
     * @param  \Closure  $callback  The HTTP request logic to execute.
     * @return InvoiceReceived The wrapped response object with calculated status.
     */
    public function catchResponse(\Closure $callback): InvoiceReceived
    {
        [$response, $status] = $this->handleResponse($callback);

        return new InvoiceReceived($response, $status);
    }
}
