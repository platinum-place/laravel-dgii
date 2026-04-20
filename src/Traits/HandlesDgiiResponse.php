<?php

namespace PlatinumPlace\LaravelDgii\Traits;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use PlatinumPlace\LaravelDgii\Enums\ArecfStatusEnum;

/**
 * Trait to handle and wrap HTTP responses from DGII.
 */
trait HandlesDgiiResponse
{
    /**
     * Execute a callback and capture its response and status.
     *
     * @param  \Closure  $callback  The HTTP request logic to execute.
     * @return array{0: array, 1: ArecfStatusEnum} Tuple containing response and status.
     */
    protected function handleResponse(\Closure $callback): array
    {
        try {
            $response = $callback();

            $status = ArecfStatusEnum::RECEIVED;
        } catch (RequestException $exception) {
            $response = $exception->response->json();

            $status = ArecfStatusEnum::NOT_RECEIVED;
        } catch (ConnectionException|\Throwable $exception) {
            $response = [
                'message' => $exception->getMessage(),
                'timestamp' => now(),
                'debug' => [
                    'file' => $exception->getFile(),
                    'line' => $exception->getLine(),
                ],
            ];

            $status = ArecfStatusEnum::NOT_RECEIVED;
        }

        return [$response, $status];
    }
}
