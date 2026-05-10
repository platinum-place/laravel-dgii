<?php

namespace PlatinumPlace\LaravelDgii\Services;

use Illuminate\Http\Client\RequestException;
use PlatinumPlace\LaravelDgii\Enums\ArecfStatusEnum;

/**
 * Utility service to wrap DGII API responses and handle communication errors.
 *
 * This class provides a consistent way to handle successful responses and
 * exceptions, translating them into a unified status format.
 */
class DgiiResponseWrapper
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Wrap a DGII request callback to handle exceptions and extract status.
     *
     * Flow: Execute callback -> If successful: return [data, RECEIVED] -> If RequestException: return [json_error, NOT_RECEIVED].
     *
     * @param  \Closure  $callback  The logic that performs the HTTP request.
     * @return array A tuple containing the response data and the ArecfStatusEnum value.
     */
    public function wrap(\Closure $callback): array
    {
        try {
            $response = $callback();

            $status = ArecfStatusEnum::RECEIVED;
        } catch (RequestException $exception) {
            $response = $exception->response->json();

            $status = ArecfStatusEnum::NOT_RECEIVED;
        }

        return [$response, $status];
    }
}
