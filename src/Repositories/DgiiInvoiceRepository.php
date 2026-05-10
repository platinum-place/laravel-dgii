<?php

namespace PlatinumPlace\LaravelDgii\Repositories;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceReceived;
use PlatinumPlace\LaravelDgii\Services\DgiiResponseWrapper;

class DgiiInvoiceRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected DgiiResponseWrapper $dgiiResponseWrapper,
    ) {
        //
    }

    /**
     * @throws ConnectionException
     */
    public function send(string $token, string $filePath, ?string $env = null): InvoiceReceived
    {
        [$response, $status] = $this->dgiiResponseWrapper->wrap(function () use ($token, $filePath, $env) {
            return Http::dgiiEcf($env)
                ->withToken($token)
                ->attachXml($filePath)
                ->post(config('dgii.endpoints.invoice.send'))
                ->json();
        });

        return new InvoiceReceived($response, $status);
    }

    /**
     * @throws ConnectionException
     */
    public function findByTrackId(string $token, string $trackId, ?string $env = null): InvoiceReceived
    {
        [$response, $status] = $this->dgiiResponseWrapper->wrap(function () use ($token, $trackId, $env) {
            return Http::dgiiEcf($env)
                ->withToken($token)
                ->get(config('dgii.endpoints.invoice.status'), [
                    'trackid' => $trackId,
                ])
                ->json();
        });

        return new InvoiceReceived($response, $status);
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function all(string $token, string $senderIdentification, string $sequenceNumber, ?string $env = null): array
    {
        return Http::dgiiEcf($env)
            ->withToken($token)
            ->get(config('dgii.endpoints.invoice.trackids'), [
                'RncEmisor' => $senderIdentification,
                'Encf' => $sequenceNumber,
            ])
            ->json();
    }
}
