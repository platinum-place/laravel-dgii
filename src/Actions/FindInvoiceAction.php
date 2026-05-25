<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class FindInvoiceAction
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
    public function handle(string $env, string $token, string $trackId): array
    {
        $response = Http::dgiiInvoice($env)
            ->withToken($token)
            ->get(config('dgii.endpoints.invoice.status'), [
                'trackid' => $trackId,
            ]);

        return $response->json();
    }
}
