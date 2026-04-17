<?php

namespace PlatinumPlace\LaravelDgii\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use PlatinumPlace\LaravelDgii\Clients\DgiiClient;

/**
 * Service to manage general DGII service status and information.
 */
class DgiiService
{
    /**
     * Create a new service instance.
     *
     * @param DgiiClient $dgiiClient Base DGII client.
     */
    public function __construct(protected DgiiClient $dgiiClient)
    {
        //
    }

    /**
     * Get the current status of all DGII web services.
     *
     * @return array List of services and their status.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getServiceStatus(): array
    {
        return $this->dgiiClient->fetchServiceStatus();
    }

    /**
     * Get scheduled maintenance windows from DGII.
     *
     * @return array List of maintenance windows.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getMaintenanceWindows(): array
    {
        return $this->dgiiClient->fetchMaintenanceWindows();
    }

    /**
     * Get the status of a specific DGII environment.
     *
     * @param string|null $env The environment to check.
     * @return array Status data for the environment.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getEnvironmentStatus(?string $env = null): array
    {
        return $this->dgiiClient->fetchEnvironmentStatus($env);
    }
}
