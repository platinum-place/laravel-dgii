<?php

namespace PlatinumPlace\LaravelDgii\Traits\Invoices;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use PlatinumPlace\LaravelDgii\Enums\ArecfStatusEnum;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceReceived;

/**
 * Trait to handle and wrap HTTP responses from DGII.
 */
trait HasResponse
{
    /**
     * Execute a callback and wrap its response into an InvoiceReceived object.
     * Handles RequestException to capture error responses from the API.
     *
     * @param  \Closure  $callback  The HTTP request logic to execute.
     * @return InvoiceReceived The wrapped response object with calculated status.
     */
    public function catchResponse(\Closure $callback): InvoiceReceived
    {
        try {
            $response = $callback();

            $arecfStatusEnum = ArecfStatusEnum::RECEIVED;
        } catch (RequestException $exception) {
            $response = $exception->response->json();

            $arecfStatusEnum = ArecfStatusEnum::NOT_RECEIVED;
        } catch (ConnectionException|\Throwable $exception) {
            $response = [
                'message' => $exception->getMessage(),
                'timestamp' => now(),
                'debug' => [
                    'file' => $exception->getFile(),
                    'line' => $exception->getLine(),
                ],
            ];

            $arecfStatusEnum = ArecfStatusEnum::NOT_RECEIVED;
        }

        return new InvoiceReceived($response, $arecfStatusEnum);
    }
}
