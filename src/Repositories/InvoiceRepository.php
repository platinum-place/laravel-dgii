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

class InvoiceRepository extends AbstractInvoiceRepository
{
    public function getHttpClient(?string $env = null): PendingRequest
    {
        return Http::dgiiInvoice($env);
    }

    protected function getEndpointKey(): string
    {
        return 'invoice';
    }

    public function sendInvoice(string $token, string $filePath, ?string $env = null): InvoiceResponse
    {
        return $this->returnInvoiceResponse(fn () => $this->send('send', $token, $filePath, $env));
    }

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
     * @throws ConnectionException
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
