<?php

namespace PlatinumPlace\LaravelDgii\Clients;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;

/**
 * Client to interact with DGII Authentication (Seed) Services.
 *
 * This class handles the first part of the DGII authentication lifecycle:
 * fetching the seed XML and validating it (after signing) to get a token.
 */
class SeedClient
{
    /**
     * Create a new client instance.
     *
     * @param  StorageRepository  $storageService  Helper to interact with file storage.
     */
    public function __construct(protected StorageRepository $storageService)
    {
        //
    }

    /**
     * Fetch the raw seed XML content for the authentication process.
     *
     * @param  string|null  $env  The environment (testecf, certecf, ecf). Uses default if null.
     * @return string The raw XML seed content.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetch(?string $env = null): string
    {
        $env ??= config('dgii.environment');

        $url = sprintf(
            '%s/%s/%s',
            config('dgii.domains.ecf'),
            $env,
            config('dgii.endpoints.auth.seed')
        );

        return Http::get($url)
            ->throw()
            ->body();
    }

    /**
     * Send the signed seed to get an access token (JWT).
     *
     * @param  string  $xmlPath  Relative path of the signed seed XML file.
     * @param  string|null  $env  The environment (testecf, certecf, ecf).
     * @return array DGII response containing the token and expiration.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetchToken(string $xmlPath, ?string $env = null): array
    {
        $filePath = $this->storageService->realPath($xmlPath);

        $env ??= config('dgii.environment');

        $url = sprintf(
            '%s/%s/%s',
            config('dgii.domains.ecf'),
            $env,
            config('dgii.endpoints.auth.validate')
        );

        return Http::attach('xml', fopen($filePath, 'rb'), basename($xmlPath))
            ->post($url)
            ->throw()
            ->json();
    }
}
