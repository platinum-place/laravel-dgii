<?php

namespace PlatinumPlace\LaravelDgii\Domains\Dgii\Actions;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class FetchEnvironmentStatusAction
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
    public function handle(string $apiKey, string $env): array
    {
        $response = Http::dgiiStatus()
            ->withHeaders([
                'accept' => '*/*',
                'Authorization' => "Apikey {$apiKey}",
            ])
            ->get(config('dgii.endpoints.status.environment'), [
                'ambiente' => match ($env) {
                    'testecf' => 1,
                    'ecf' => 2,
                    'certecf' => 3,
                },
            ]);

        return $response->json();
    }
}
