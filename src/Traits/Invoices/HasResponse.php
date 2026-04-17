<?php

namespace PlatinumPlace\LaravelDgii\Traits\Invoices;

use Illuminate\Http\Client\RequestException;
use PlatinumPlace\LaravelDgii\Enums\ArecfStatusEnum;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceReceived;

trait HasResponse
{
    public function catchResponse(\Closure $callback): InvoiceReceived
    {
        try {
            $response = $callback();

            $arecfStatusEnum = ArecfStatusEnum::RECEIVED;
        } catch (RequestException $exception) {
            $response = $exception->response->json();

            $arecfStatusEnum = ArecfStatusEnum::NOT_RECEIVED;
        }

        return new InvoiceReceived($response, $arecfStatusEnum);
    }
}
