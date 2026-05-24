<?php

namespace PlatinumPlace\LaravelDgii\Domains\CancellationRanges\Actions;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class SendCancellationRangeAction
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * @throws ConnectionException
     */
    public function handle(string $env, string $token, string $filePath): array
    {
        $response = Http::dgiiInvoice($env)
            ->withToken($token)
            ->attachXml($filePath)
            ->post(config('dgii.endpoints.cancellation.send'));

        return $response->json();
    }
}
