<?php

namespace PlatinumPlace\LaravelDgii\Repositories\Abstracts;

use Illuminate\Http\Client\ConnectionException;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceResponse;
use PlatinumPlace\LaravelDgii\Enums\ArecfStatusEnum;
use PlatinumPlace\LaravelDgii\Exceptions\DgiiRepositoryException;

/**
 * Base repository for handling electronic invoice operations.
 */
abstract class AbstractInvoiceRepository extends AbstractApiRepository
{
    /**
     * Processes the API response and returns a typed InvoiceResponse.
     *
     * @throws ConnectionException
     * @throws DgiiRepositoryException
     */
    public function returnResponse(\Closure $closure): InvoiceResponse
    {
        $response = $closure();

        $status = $response['receive'] === false ?
            ArecfStatusEnum::NOT_RECEIVED :
            ArecfStatusEnum::RECEIVED;

        // Return the processed response DTO
        return new InvoiceResponse($response, $status);
    }
}
