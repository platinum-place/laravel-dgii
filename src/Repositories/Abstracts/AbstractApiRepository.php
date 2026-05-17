<?php

namespace PlatinumPlace\LaravelDgii\Repositories\Abstracts;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;
use PlatinumPlace\LaravelDgii\Exceptions\DgiiRepositoryException;

abstract class AbstractApiRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    abstract public function getHttpClient(?string $env = null): PendingRequest;

    abstract protected function getEndpointKey(): string;

    protected function getEndpoint(string $endpoint): string
    {
        return config("dgii.endpoints.{$this->getEndpointKey()}.{$endpoint}");
    }

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
     * @throws ConnectionException
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
