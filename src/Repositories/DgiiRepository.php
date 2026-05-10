<?php

namespace PlatinumPlace\LaravelDgii\Repositories;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

/**
 * Repository for managing core DGII service interactions such as authentication and system status.
 *
 * This class serves as a data source for fetching seeds, validating tokens,
 * and checking the operational status of DGII's electronic billing environments.
 */
class DgiiRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Request a fresh authentication seed from DGII.
     *
     * @param  string|null  $env  The target DGII environment (testecf, certecf, ecf).
     * @return string The raw seed string returned by DGII.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getSeed(?string $env = null): string
    {
        // Execute the GET request to the seed endpoint
        return Http::dgiiEcf($env)
            ->get(config('dgii.endpoints.auth.seed'))
            ->body();
    }

    /**
     * Validate a signed seed XML and exchange it for an authentication token.
     *
     * @param  string  $path  The absolute path to the signed seed XML file.
     * @param  string|null  $env  The target DGII environment (testecf, certecf, ecf).
     * @return array The JSON response containing the access token and expiration details.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getToken(string $path, ?string $env = null): array
    {
        // Attach the signed XML and execute the POST request to the validation endpoint
        return Http::dgiiEcf($env)
            ->attachXml($path)
            ->post(config('dgii.endpoints.auth.validate'))
            ->json();
    }

    /**
     * Check the operational status of DGII web services.
     *
     * @param  string|null  $env  The target DGII environment (testecf, certecf, ecf).
     * @return array The operational status data for various DGII services.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getServiceStatus(?string $env = null): array
    {
        // Execute the GET request to the global services status endpoint
        return Http::dgiiStatusEcf($env)
            ->get(config('dgii.endpoints.status.services'))
            ->json();
    }

    /**
     * Retrieve the list of scheduled maintenance windows for DGII systems.
     *
     * @param  string|null  $env  The target DGII environment (testecf, certecf, ecf).
     * @return array List of maintenance windows and their descriptions.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getMaintenanceWindows(?string $env = null): array
    {
        // Execute the GET request to the maintenance schedule endpoint
        return Http::dgiiStatusEcf($env)
            ->get(config('dgii.endpoints.status.maintenance'))
            ->json();
    }

    /**
     * Check the overall availability of a specific DGII environment.
     *
     * @param  string|null  $env  The target DGII environment (testecf, certecf, ecf).
     * @return array Environmental status data, including availability percentages.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getEnvironmentStatus(?string $env = null): array
    {
        // Map the environment string to the integer code expected by DGII
        $environmentCode = match ($env) {
            'ecf' => 2,
            'certecf' => 3,
            default => 1,
        };

        // Execute the GET request with the environment parameter
        return Http::dgiiStatusEcf($env)
            ->get(config('dgii.endpoints.status.environment'), [
                'ambiente' => $environmentCode,
            ])
            ->json();
    }
}
