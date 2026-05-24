<?php

namespace PlatinumPlace\LaravelDgii\Domains\Dgii\Actions;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class FetchServiceStatusAction
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
    public function handle(string $apiKey): array
    {
        $response = Http::dgiiStatus()
            ->withHeaders([
                'accept' => '*/*',
                'Authorization' => "Apikey {$apiKey}",
            ])
            ->get(config('dgii.endpoints.status.services'));

        return $response->json();
    }
}
