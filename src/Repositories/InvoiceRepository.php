<?php

namespace PlatinumPlace\LaravelDgii\Repositories;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceResponse;
use PlatinumPlace\LaravelDgii\Exceptions\DgiiRepositoryException;
use PlatinumPlace\LaravelDgii\Repositories\Abstracts\AbstractInvoiceRepository;

/**
 * Repository for handling electronic invoice operations with the DGII API.
 */
class InvoiceRepository extends AbstractInvoiceRepository
{
    /**
     * Get the configured HTTP client for the Invoice API.
     */
    public function getHttpClient(?string $env = null): PendingRequest
    {
        return Http::dgiiInvoice($env);
    }

    /**
     * Get the endpoint key for invoice operations.
     */
    protected function getEndpointKey(): string
    {
        return 'invoice';
    }

    /**
     * Sends an invoice to the DGII.
     *
     * @throws ConnectionException
     * @throws DgiiRepositoryException
     */
    public function sendInvoice(string $token, string $filePath, ?string $env = null): InvoiceResponse
    {
        return $this->returnInvoiceResponse(fn () => $this->send('send', $token, $filePath, $env));
    }

    /**
     * Find an invoice processing status by its TrackId.
     *
     * @throws ConnectionException
     * @throws DgiiRepositoryException
     */
    public function findByTrackId(string $token, string $trackId, ?string $env = null): InvoiceResponse
    {
        return $this->returnInvoiceResponse(
            fn () => $this->find(
                'status',
                $token,
                [
                    'trackid' => $trackId,
                ],
                $env
            )
        );
    }

    /**
     * List TrackIds for a given sender and sequence number.
     *
     * @throws ConnectionException
     * @throws RequestException
     */
    public function list(string $token, string $senderIdentification, string $sequenceNumber, ?string $env = null): Collection
    {
        return $this->all(
            'trackids',
            $token,
            [
                'RncEmisor' => $senderIdentification,
                'Encf' => $sequenceNumber,
            ],
            $env
        );
    }
}
