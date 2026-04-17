<?php

namespace PlatinumPlace\LaravelDgii\Clients;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use PlatinumPlace\LaravelDgii\Support\StorageService;

/**
 * Client to interact with DGII Commercial Approval Services (ARECF).
 *
 * This class handles the transmission of commercial approval or rejection
 * for received e-CF documents.
 */
class CommercialApprovalClient
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
     * Send a commercial approval for a received e-CF.
     *
     * @param  string  $token  Valid authentication token.
     * @param  string  $xmlPath  Relative path of the approval XML file.
     * @param  string|null  $env  The environment (testecf, certecf, ecf).
     * @return array DGII response for the submission.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function send(string $token, string $xmlPath, ?string $env = null): array
    {
        $filePath = $this->storageService->path($xmlPath);

        $env ??= config('dgii.environment');

        $url = sprintf(
            '%s/%s/aprobacioncomercial/api/aprobacioncomercial',
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
