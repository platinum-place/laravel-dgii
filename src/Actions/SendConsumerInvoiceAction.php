<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class SendConsumerInvoiceAction
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
        $response = Http::dgiiConsumerInvoice($env)
            ->withToken($token)
            ->attachXml($filePath)
            ->post(config('dgii.endpoints.consumer_invoice.send'));

        return $response->json();
    }
}
