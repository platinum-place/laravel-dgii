<?php

namespace PlatinumPlace\LaravelDgii\Repositories;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceReceived;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\Services\DgiiResponseWrapper;

class DgiiConsumeInvoiceRepository
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
            return Http::dgiiFc($env)
                ->withToken($token)
                ->attachXml($filePath)
                ->post(config('dgii.endpoints.fc.send'))
                ->json();
        });

        return new InvoiceReceived($response, $status);
    }

    /**
     * @throws ConnectionException
     */
    public function find(string $token, InvoiceXml $xml, ?string $env = null): InvoiceReceived
    {
        [$response, $status] = $this->dgiiResponseWrapper->wrap(function () use ($token, $xml, $env) {
            return Http::dgiiFc($env)
                ->withToken($token)
                ->get(config('dgii.endpoints.fc.status'), [
                    'RNC_Emisor' => $xml->getSenderIdentification(),
                    'ENCF' => $xml->getSequenceNumber(),
                    'Cod_Seguridad_eCF' => $xml->getSecurityCode(),
                ])
                ->json();
        });

        return new InvoiceReceived($response, $status);
    }
}
