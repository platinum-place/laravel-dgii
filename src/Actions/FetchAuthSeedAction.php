<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class FetchAuthSeedAction
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
    public function handle(string $env): string
    {
        $response = Http::dgiiInvoice($env)
            ->get(config('dgii.endpoints.auth.seed'));

        return $response->body();
    }
}
