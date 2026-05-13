<?php

namespace PlatinumPlace\LaravelDgii\Repositories;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use PlatinumPlace\LaravelDgii\Exceptions\DgiiRepositoryException;
use PlatinumPlace\LaravelDgii\Repositories\Abstracts\AbstractApiRepository;

/**
 * Repository for handling authentication seeds and tokens with the DGII API.
 */
class SeedRepository extends AbstractApiRepository
{
    /**
     * Get the configured HTTP client for the e-CF API.
     */
    public function getHttpClient(?string $env = null): PendingRequest
    {
        return Http::dgiiEcf($env);
    }

    /**
     * Get the endpoint key for authentication operations.
     */
    protected function getEndpointKey(): string
    {
        return 'auth';
    }

    /**
     * Retrieves a new authentication seed from the DGII.
     *
     * @throws ConnectionException
     */
    public function getSeed(?string $env = null): string
    {
        return $this->getHttpClient($env)
            ->get($this->getEndpoint('seed'))
            ->body();
    }

    /**
     * Exchanges a signed seed for an access token.
     *
     * @throws ConnectionException
     * @throws DgiiRepositoryException
     */
    public function getToken(string $path, ?string $env = null): array
    {
        return $this->getHttpClient($env)
            ->attachXml($path)
            ->post($this->getEndpoint('validate'))
            ->json() ?? throw new DgiiRepositoryException('Error validando el token de acceso con la DGII.');
    }
}
