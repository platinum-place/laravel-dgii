<?php

namespace PlatinumPlace\LaravelDgii\Repositories;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceResponse;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\Exceptions\DgiiRepositoryException;
use PlatinumPlace\LaravelDgii\Repositories\Abstracts\AbstractInvoiceRepository;

/**
 * Repository for handling consumer invoice operations (Factura de Consumo Electrónica).
 */
class ConsumerInvoiceRepository extends AbstractInvoiceRepository
{
    /**
     * Get the configured HTTP client for the Consumer Invoice API.
     */
    public function getHttpClient(?string $env = null): PendingRequest
    {
        return Http::dgiiConsumerInvoice($env);
    }

    /**
     * Get the endpoint key for consumer invoice operations.
     */
    protected function getEndpointKey(): string
    {
        return 'consumer_invoice';
    }

    /**
     * Sends a consumer invoice to the DGII.
     *
     * @throws ConnectionException
     * @throws DgiiRepositoryException
     */
    public function sendConsumerInvoice(string $token, string $filePath, ?string $env = null): InvoiceResponse
    {
        return $this->returnResponse(fn () => $this->send('send', $token, $filePath, $env));
    }

    /**
     * Find a consumer invoice status using its XML metadata.
     *
     * @throws ConnectionException
     * @throws DgiiRepositoryException
     */
    public function findConsumerInvoice(string $token, InvoiceXml $xml, ?string $env = null): InvoiceResponse
    {
        return $this->returnResponse(
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
