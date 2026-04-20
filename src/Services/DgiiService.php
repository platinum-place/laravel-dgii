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
     * @param  DgiiClient  $dgiiClient  Base DGII client.
     */
    public function __construct(protected DgiiClient $dgiiClient)
    {
        //
    }

    /**
     * Get the current status of all DGII web services (e-CF, Tracking, etc.).
     *
     * @return array List of services and their current operational status.
     *
     * @throws ConnectionException|RequestException
     */
    public function getServiceStatus(): array
    {
        return $this->dgiiClient->fetchServiceStatus();
    }

    /**
     * Get scheduled maintenance windows published by DGII.
     *
     * @return array List of planned maintenance events.
     *
     * @throws ConnectionException|RequestException
     */
    public function getMaintenanceWindows(): array
    {
        return $this->dgiiClient->fetchMaintenanceWindows();
    }

    /**
     * Get the availability status of a specific DGII environment (test, cert, prod).
     *
     * @param  string|null  $env  The environment code to check.
     * @return array Status data for the requested environment.
     *
     * @throws ConnectionException|RequestException
     */
    public function getEnvironmentStatus(?string $env = null): array
    {
        return $this->dgiiClient->fetchEnvironmentStatus($env);
    }
}
