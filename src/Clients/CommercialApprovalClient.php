<?php

namespace PlatinumPlace\LaravelDgii\Clients;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;

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
     */
    public function __construct()
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
        $env ??= config('dgii.environment');

        $url = sprintf(
            '%s/%s/%s',
            config('dgii.domains.ecf'),
            $env,
            config('dgii.endpoints.approval.send')
        );

        return Http::withToken($token)
            ->attach('xml', fopen($xmlPath, 'rb'), basename($xmlPath))
            ->post($url)
            ->throw()
            ->json();
    }
}
