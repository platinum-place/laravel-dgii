<?php

namespace PlatinumPlace\LaravelDgii\Repositories;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use PlatinumPlace\LaravelDgii\Data\CommercialApproval\CommercialApprovalResponse;
use PlatinumPlace\LaravelDgii\Exceptions\DgiiRepositoryException;
use PlatinumPlace\LaravelDgii\Repositories\Abstracts\AbstractApiRepository;

/**
 * Repository for handling commercial approval (ARECF/ACECF) operations.
 */
class CommercialApprovalRepository extends AbstractApiRepository
{
    /**
     * Get the configured HTTP client for the Invoice API.
     */
    public function getHttpClient(?string $env = null): PendingRequest
    {
        return Http::dgiiInvoice($env);
    }

    /**
     * Get the endpoint key for approval operations.
     */
    protected function getEndpointKey(): string
    {
        return 'approval';
    }

    /**
     * Sends a commercial approval (ARECF/ACECF) to the DGII.
     *
     * @throws ConnectionException
     * @throws DgiiRepositoryException
     */
    public function sendCommercialApproval(string $token, string $filePath, ?string $env = null): CommercialApprovalResponse
    {
        $response = $this->send('send', $token, $filePath, $env);

        return new CommercialApprovalResponse($response);
    }
}
