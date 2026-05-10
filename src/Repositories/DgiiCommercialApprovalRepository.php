<?php

namespace PlatinumPlace\LaravelDgii\Repositories;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

/**
 * Repository for handling commercial approvals of tax documents with DGII.
 *
 * This class serves as a data source for the external DGII API endpoints
 * related to the submission of commercial approval responses for e-CFs.
 */
class DgiiCommercialApprovalRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Send the commercial approval XML to DGII.
     *
     * @param  string  $token  The authentication token obtained from DGII.
     * @param  string  $filePath  The absolute path to the signed XML file on disk.
     * @param  string|null  $env  The target DGII environment (testecf, certecf, ecf).
     * @return array The raw JSON response from DGII.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function send(string $token, string $filePath, ?string $env = null): array
    {
        // Build and execute the HTTP request to DGII
        return Http::dgiiEcf($env)
            ->withToken($token)
            ->attachXml($filePath)
            ->post(config('dgii.endpoints.approval.send'))
            ->json();
    }
}
