<?php

namespace PlatinumPlace\LaravelDgii\Clients;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use PlatinumPlace\LaravelDgii\Support\StorageService;

/**
 * Client to interact with DGII Consumption Invoice Services (RFCE).
 *
 * This class handles the transmission of Consumer Electronic Invoices
 * to the specific DGII endpoints for this type of document.
 */
class ConsumeInvoiceClient
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
     * Send a Consumer Electronic Invoice (RFCE) to DGII.
     *
     * @param  string  $token  Valid authentication token.
     * @param  string  $xmlPath  Relative path of the signed RFCE XML file.
     * @param  string|null  $env  The environment (testecf, certecf, ecf).
     * @return array DGII response with trackId.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function send(string $token, string $xmlPath, ?string $env = null): array
    {
        $filePath = $this->storageService->path($xmlPath);

        $env ??= config('dgii.environment');

        $url = sprintf(
            '%s/%s/recepcionfc/api/recepcion/ecf',
            config('dgii.domains.fc'),
            $env
        );

        return Http::withToken($token)
            ->attach('xml', fopen($filePath, 'r'), basename($xmlPath))
            ->post($url)
            ->throw()
            ->json();
    }
}
