<?php

namespace PlatinumPlace\LaravelDgii\Repositories;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use PlatinumPlace\LaravelDgii\Data\CancellationRange\CancellationRangeResponse;

/**
 * Repository for handling digital tax document cancellation ranges with DGII.
 *
 * This class serves as a data source for the external DGII API endpoints
 * related to the submission and tracking of e-CF cancellation ranges.
 */
class DgiiCancellationRangeRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Send the cancellation range XML to DGII.
     *
     * @param  string  $token  The authentication token obtained from DGII.
     * @param  string  $filePath  The absolute path to the signed XML file on disk.
     * @param  string|null  $env  The target DGII environment (testecf, certecf, ecf).
     * @return CancellationRangeResponse The response object containing DGII submission details.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function send(string $token, string $filePath, ?string $env = null): CancellationRangeResponse
    {
        // Build and execute the HTTP request to DGII
        $response = Http::dgiiEcf($env)
            ->withToken($token)
            ->attachXml($filePath)
            ->post(config('dgii.endpoints.cancellation.send'))
            ->json();

        // Return the processed response DTO
        return new CancellationRangeResponse($response);
    }
}
