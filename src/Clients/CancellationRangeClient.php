<?php

namespace PlatinumPlace\LaravelDgii\Clients;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use PlatinumPlace\LaravelDgii\Support\StorageService;

/**
 * Client to interact with DGII Cancellation Range Services (ANECF).
 *
 * This class handles the transmission of sequence range cancellation
 * requests to the specific DGII endpoints.
 */
class CancellationRangeClient
{
    /**
     * Create a new client instance.
     *
     * @param StorageService $storageService Helper to interact with file storage.
     */
    public function __construct(protected StorageService $storageService)
    {
        //
    }

    /**
     * Send a request to cancel a range of e-CF sequences.
     *
     * @param string $token Valid authentication token.
     * @param string $xmlPath Relative path of the cancellation XML file.
     * @param string|null $env The environment (testecf, certecf, ecf).
     * @return array DGII response about the cancellation.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function send(string $token, string $xmlPath, ?string $env = null): array
    {
        $filePath = $this->storageService->path($xmlPath);

        $env ??= config('dgii.environment');

        $url = sprintf(
            '%s/%s/anulacionrangos/api/operaciones/anularrango',
            config('dgii.domains.ecf'),
            $env
        );

        return Http::withToken($token)
            ->attach('xml', fopen($filePath, 'r'), basename($xmlPath))
            ->post($url)
            ->throw()
            ->json();
    }
}
