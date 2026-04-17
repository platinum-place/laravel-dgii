<?php

namespace PlatinumPlace\LaravelDgii\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use PlatinumPlace\LaravelDgii\Clients\DgiiClient;

class DgiiService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected DgiiClient $dgiiClient)
    {
        //
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getServiceStatus(): array
    {
        return $this->dgiiClient->fetchServiceStatus();
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getMaintenanceWindows(): array
    {
        return $this->dgiiClient->fetchMaintenanceWindows();
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getEnvironmentStatus(?string $env = null): array
    {
        return $this->dgiiClient->fetchEnvironmentStatus($env);
    }
}
