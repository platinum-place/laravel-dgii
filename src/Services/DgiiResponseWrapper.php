<?php

namespace PlatinumPlace\LaravelDgii\Services;

use Illuminate\Http\Client\RequestException;
use PlatinumPlace\LaravelDgii\Enums\ArecfStatusEnum;

class DgiiResponseWrapper
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

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
