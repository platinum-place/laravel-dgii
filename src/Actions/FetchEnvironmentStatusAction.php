<?php

namespace PlatinumPlace\LaravelDgii\Actions;

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
    public function handle(string $env): array
    {
        $response = Http::dgiiStatus()
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
