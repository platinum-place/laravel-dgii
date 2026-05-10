<?php

namespace PlatinumPlace\LaravelDgii\Repositories;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class DgiiServiceRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getSeed(?string $env = null): string
    {
        return Http::dgiiEcf($env)
            ->get(config('dgii.endpoints.auth.seed'))
            ->body();
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getToken(string $path, ?string $env = null): array
    {
        return Http::dgiiEcf($env)
            ->attachXml($path)
            ->post(config('dgii.endpoints.auth.validate'))
            ->json();
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getServiceStatus(?string $env = null): array
    {
        return Http::dgiiStatusEcf($env)
            ->get(config('dgii.endpoints.status.services'))
            ->json();
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getMaintenanceWindows(?string $env = null): array
    {
        return Http::dgiiStatusEcf($env)
            ->get(config('dgii.endpoints.status.maintenance'))
            ->json();
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getEnvironmentStatus(?string $env = null): array
    {
        return Http::dgiiStatusEcf($env)
            ->get(config('dgii.endpoints.status.environment'), [
                'ambiente' => match ($env) {
                    'ecf' => 2,
                    'certecf' => 3,
                    default => 1,
                },
            ])
            ->json();
    }
}
