<?php

namespace PlatinumPlace\LaravelDgii\Clients;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use PlatinumPlace\LaravelDgii\Support\StorageService;

/**
 * Client to interact with DGII Web Services.
 *
 * This class centralizes general HTTP requests to DGII status endpoints,
 * providing information about service availability and maintenance windows.
 */
class DgiiClient
{
    /**
     * Create a new client instance.
     *
     * @param  StorageService  $storageService  Helper to interact with file storage.
     */
    public function __construct(protected StorageService $storageService)
    {
        //
    }

    /**
     * Fetch the general status of DGII web services.
     *
     * @return array List of services and their availability status.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetchServiceStatus(): array
    {
        $url = sprintf(
            '%s/api/estatusservicios/obtenerestatus',
            config('dgii.domains.statusecf'),
        );

        return Http::withHeaders([
            'accept' => '*/*',
            'Authorization' => 'Apikey '.config('dgii.api_key'),
        ])
            ->get($url)
            ->throw()
            ->json();
    }

    /**
     * Fetch scheduled maintenance windows from DGII.
     *
     * @return array List of maintenance windows.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetchMaintenanceWindows(): array
    {
        $url = sprintf(
            '%s/api/estatusservicios/obtenerventanasmantenimiento',
            config('dgii.domains.statusecf'),
        );

        return Http::withHeaders([
            'accept' => '*/*',
            'Authorization' => 'Apikey '.config('dgii.api_key'),
        ])
            ->get($url)
            ->throw()
            ->json();
    }

    /**
     * Verify the status of a specific environment (Production, Testing, Certification).
     *
     * @param  string|null  $env  The environment to check. Uses configured default if null.
     * @return array Status of the requested environment.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetchEnvironmentStatus(?string $env = null): array
    {
        $env ??= config('dgii.environment');
        $url = sprintf(
            '%s/api/estatusservicios/verificarestado',
            config('dgii.domains.statusecf'),
        );

        return Http::withHeaders([
            'accept' => '*/*',
            'Authorization' => 'Apikey '.config('dgii.api_key'),
        ])
            ->get($url, [
                'ambiente' => match ($env) {
                    'ecf' => 2,
                    'certecf' => 3,
                    default => 1,
                },
            ])
            ->throw()
            ->json();
    }
}
