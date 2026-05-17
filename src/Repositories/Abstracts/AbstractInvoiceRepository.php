<?php

namespace PlatinumPlace\LaravelDgii\Repositories\Abstracts;

use Illuminate\Http\Client\ConnectionException;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceResponse;
use PlatinumPlace\LaravelDgii\Enums\AcknowledgmentStatusEnum;
use PlatinumPlace\LaravelDgii\Exceptions\DgiiRepositoryException;

abstract class AbstractInvoiceRepository extends AbstractApiRepository
{
    public function returnInvoiceResponse(\Closure $closure): InvoiceResponse
    {
        $response = $closure();

        $status = $response['receive'] === false ?
            AcknowledgmentStatusEnum::NOT_RECEIVED :
            AcknowledgmentStatusEnum::RECEIVED;

        return new InvoiceResponse($response, $status);
    }
}
