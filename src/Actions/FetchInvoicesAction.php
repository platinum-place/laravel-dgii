<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class FetchInvoicesAction
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
    public function handle(string $env, string $token, string $senderIdentification, string $sequenceNumber): array
    {
        $response = Http::dgiiInvoice($env)
            ->withToken($token)
            ->get(config('dgii.endpoints.invoice.list'), [
                'RncEmisor' => $senderIdentification,
                'Encf' => $sequenceNumber,
            ]);

        return $response->json();
    }
}
