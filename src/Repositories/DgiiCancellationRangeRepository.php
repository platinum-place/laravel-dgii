<?php

namespace PlatinumPlace\LaravelDgii\Repositories;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use PlatinumPlace\LaravelDgii\Data\CancellationRange\CancellationRangeReceived;

class DgiiCancellationRangeRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function send(string $token, string $filePath, ?string $env = null): CancellationRangeReceived
    {
        $response = Http::dgiiEcf($env)
            ->withToken($token)
            ->attachXml($filePath)
            ->post(config('dgii.endpoints.cancellation.send'))
            ->json();

        return new CancellationRangeReceived($response);
    }
}
