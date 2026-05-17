<?php

namespace PlatinumPlace\LaravelDgii\Repositories;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use PlatinumPlace\LaravelDgii\Exceptions\DgiiRepositoryException;
use PlatinumPlace\LaravelDgii\Repositories\Abstracts\AbstractApiRepository;

class StatusRepository extends AbstractApiRepository
{
    public function getHttpClient(?string $env = null): PendingRequest
    {
        return Http::dgiiStatus();
    }

    protected function getEndpointKey(): string
    {
        return 'status';
    }

    /**
     * @throws ConnectionException
     */
    public function getServiceStatus(): array
    {
        return $this->getHttpClient()
            ->get($this->getEndpoint('services'))
            ->json() ?? throw new DgiiRepositoryException('Error obteniendo el estado de los servicios de la DGII.');
    }

    /**
     * @throws ConnectionException
     */
    public function getMaintenanceWindows(): array
    {
        return $this->getHttpClient()
            ->get($this->getEndpoint('maintenance'))
            ->json() ?? throw new DgiiRepositoryException('Error obteniendo las ventanas de mantenimiento de la DGII.');
    }

    /**
     * @throws ConnectionException
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
