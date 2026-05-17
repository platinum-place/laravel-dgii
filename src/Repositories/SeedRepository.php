<?php

namespace PlatinumPlace\LaravelDgii\Repositories;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use PlatinumPlace\LaravelDgii\Exceptions\DgiiRepositoryException;
use PlatinumPlace\LaravelDgii\Repositories\Abstracts\AbstractApiRepository;

class SeedRepository extends AbstractApiRepository
{
    public function getHttpClient(?string $env = null): PendingRequest
    {
        return Http::dgiiInvoice($env);
    }

    protected function getEndpointKey(): string
    {
        return 'auth';
    }

    /**
     * @throws ConnectionException
     */
    public function getSeed(?string $env = null): string
    {
        return $this->getHttpClient($env)
            ->get($this->getEndpoint('seed'))
            ->body() ?? throw new DgiiRepositoryException('Error validando el token de acceso con la DGII.');
    }

    /**
     * @throws ConnectionException
     */
    public function getToken(string $path, ?string $env = null): array
    {
        return $this->getHttpClient($env)
            ->attachXml($path)
            ->post($this->getEndpoint('validate'))
            ->json() ?? throw new DgiiRepositoryException('Error validando el token de acceso con la DGII.');
    }
}
