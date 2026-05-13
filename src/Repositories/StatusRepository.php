<?php

namespace PlatinumPlace\LaravelDgii\Repositories;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use PlatinumPlace\LaravelDgii\Exceptions\DgiiRepositoryException;
use PlatinumPlace\LaravelDgii\Repositories\Abstracts\AbstractApiRepository;

/**
 * Repository for querying the operational status of DGII services.
 */
class StatusRepository extends AbstractApiRepository
{
    /**
     * Get the configured HTTP client for the status API.
     */
    public function getHttpClient(?string $env = null): PendingRequest
    {
        return Http::dgiiStatusEcf();
    }

    /**
     * Get the endpoint key for status queries.
     */
    protected function getEndpointKey(): string
    {
        return 'status';
    }

    /**
     * Retrieves the general status of all DGII e-CF services.
     *
     * @throws ConnectionException
     * @throws DgiiRepositoryException
     */
    public function getServiceStatus(): array
    {
        return $this->getHttpClient()
            ->get($this->getEndpoint('services'))
            ->json() ?? throw new DgiiRepositoryException('Error obteniendo el estado de los servicios de la DGII.');
    }

    /**
     * Retrieves upcoming maintenance windows from the DGII.
     *
     * @throws ConnectionException
     * @throws DgiiRepositoryException
     */
    public function getMaintenanceWindows(): array
    {
        return $this->getHttpClient()
            ->get($this->getEndpoint('maintenance'))
            ->json() ?? throw new DgiiRepositoryException('Error obteniendo las ventanas de mantenimiento de la DGII.');
    }

    /**
     * Retrieves the status for a specific environment (test, cert, prod).
     *
     * @throws ConnectionException
     * @throws DgiiRepositoryException
     */
    public function getEnvironmentStatus(string $env): array
    {
        $environmentCode = match ($env) {
            'testecf' => 1,
            'ecf' => 2,
            'certecf' => 3,
        };

        return $this->getHttpClient()
            ->get($this->getEndpoint('environment'), [
                'ambiente' => $environmentCode,
            ])
            ->json() ?? throw new DgiiRepositoryException('Error obteniendo el estado del entorno de la DGII.');
    }
}
