<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class FetchConsumerInvoiceAction
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
    public function handle(string $env, string $token, string $senderIdentification, string $sequenceNumber, string $securityCode): array
    {
        $response = Http::dgiiInvoice($env)
            ->withToken($token)
            ->get(config('dgii.endpoints.consumer_invoice.status'), [
                'RNC_Emisor' => $senderIdentification,
                'ENCF' => $sequenceNumber,
                'Cod_Seguridad_eCF' => $securityCode,
            ]);

        return $response->json();
    }
}
