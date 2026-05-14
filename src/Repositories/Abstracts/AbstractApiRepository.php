<?php

namespace PlatinumPlace\LaravelDgii\Repositories\Abstracts;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;
use PlatinumPlace\LaravelDgii\Exceptions\DgiiRepositoryException;

/**
 * Base repository for handling common DGII API operations.
 */
abstract class AbstractApiRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the configured HTTP client for the DGII API.
     */
    abstract public function getHttpClient(?string $env = null): PendingRequest;

    /**
     * Get the endpoint key used for configuration lookups.
     */
    abstract protected function getEndpointKey(): string;

    /**
     * Resolve the full endpoint URL for a given key.
     */
    protected function getEndpoint(string $endpoint): string
    {
        return config("dgii.endpoints.{$this->getEndpointKey()}.{$endpoint}");
    }

    /**
     * Processes the API response and handles common request exceptions.
     *
     * @throws DgiiRepositoryException
     */
    protected function returnResponse(\Closure $closure): array
    {
        try {
            $response = $closure();

            if (empty($response)) {
                throw new DgiiRepositoryException('Error al momento de enviar datos a DGII.');
            }

            $response['receive'] = true;
        } catch (RequestException $exception) {
            $response = $exception->response->json();

            $response['receive'] = false;
        }

        return $response;
    }

    /**
     * Sends a file to the DGII API.
     *
     * @throws ConnectionException
     * @throws DgiiRepositoryException
     */
    public function send(string $endpoint, string $token, string $filePath, ?string $env = null): array
    {
        return $this->returnResponse(
            fn () => $this->getHttpClient($env)
                ->withToken($token)
                ->attachXml($filePath)
                ->post($this->getEndpoint($endpoint))
                ->json()
        );
    }

    /**
     * Find a single record from the DGII API.
     *
     * @throws ConnectionException
     * @throws DgiiRepositoryException
     */
    public function find(string $endpoint, string $token, array $params, ?string $env = null): array
    {
        return $this->returnResponse(
            fn () => $this->getHttpClient($env)
                ->withToken($token)
                ->get($this->getEndpoint($endpoint), $params)
                ->json()
        );
    }

    /**
     * Get a collection of records from the DGII API.
     *
     * @throws ConnectionException
     * @throws RequestException
     */
    public function all(string $endpoint, string $token, array $params, ?string $env = null): Collection
    {
        $response = $this->getHttpClient($env)
            ->withToken($token)
            ->get($this->getEndpoint($endpoint), $params)
            ->json();

        return collect($response);
    }
}
