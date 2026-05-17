<?php

namespace PlatinumPlace\LaravelDgii\Repositories;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceResponse;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\Exceptions\DgiiRepositoryException;
use PlatinumPlace\LaravelDgii\Repositories\Abstracts\AbstractInvoiceRepository;

class ConsumerInvoiceRepository extends AbstractInvoiceRepository
{
    public function getHttpClient(?string $env = null): PendingRequest
    {
        return Http::dgiiConsumerInvoice($env);
    }

    protected function getEndpointKey(): string
    {
        return 'consumer_invoice';
    }

    public function sendConsumerInvoice(string $token, string $filePath, ?string $env = null): InvoiceResponse
    {
        return $this->returnInvoiceResponse(fn () => $this->send('send', $token, $filePath, $env));
    }

    public function findConsumerInvoice(string $token, InvoiceXml $xml, ?string $env = null): InvoiceResponse
    {
        return $this->returnInvoiceResponse(
            fn () => $this->find(
                'status',
                $token,
                [
                    'RNC_Emisor' => $xml->getSenderIdentification(),
                    'ENCF' => $xml->getSequenceNumber(),
                    'Cod_Seguridad_eCF' => $xml->getSecurityCode(),
                ],
                $env
            )
        );
    }
}
