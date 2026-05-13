<?php

namespace PlatinumPlace\LaravelDgii\Repositories;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use PlatinumPlace\LaravelDgii\Data\CancellationRange\CancellationRangeResponse;
use PlatinumPlace\LaravelDgii\Exceptions\DgiiRepositoryException;
use PlatinumPlace\LaravelDgii\Repositories\Abstracts\AbstractApiRepository;

/**
 * Repository for handling electronic cancellation range (ANECF) operations.
 */
class CancellationRangeRepository extends AbstractApiRepository
{
    /**
     * Get the configured HTTP client for the e-CF API.
     */
    public function getHttpClient(?string $env = null): PendingRequest
    {
        return Http::dgiiEcf($env);
    }

    /**
     * Get the endpoint key for cancellation operations.
     */
    protected function getEndpointKey(): string
    {
        return 'cancellation';
    }

    /**
     * Sends a cancellation range (ANECF) to the DGII.
     *
     * @throws ConnectionException
     * @throws DgiiRepositoryException
     */
    public function sendCancellationRange(string $token, string $filePath, ?string $env = null): CancellationRangeResponse
    {
        $response = $this->send('send', $token, $filePath, $env);

        return new CancellationRangeResponse($response);
    }
}
