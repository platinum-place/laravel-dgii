<?php

namespace PlatinumPlace\LaravelDgii\Actions;

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
    public function handle(): array
    {
        $response = Http::dgiiStatus()
            ->get(config('dgii.endpoints.status.services'));

        return $response->json();
    }
}
