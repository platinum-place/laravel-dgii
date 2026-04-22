<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use PlatinumPlace\LaravelDgii\Enums\ArecfStatusEnum;

/**
 * Action to persist signed Invoice XML(s) to storage.
 */
class WrapDgiiResponseAction
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function handle(\Closure $callback): array
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
