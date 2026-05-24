<?php

namespace PlatinumPlace\LaravelDgii\Domains\Seeds\Actions;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class SendAuthSeedAction
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
    public function handle(string $env, string $filePath): array
    {
        $response = Http::dgiiInvoice($env)
            ->attachXml($filePath)
            ->post(config('dgii.endpoints.auth.validate'));

        return $response->json();
    }
}
