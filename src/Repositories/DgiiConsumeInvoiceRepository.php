<?php

namespace PlatinumPlace\LaravelDgii\Repositories;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceReceived;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\Services\DgiiResponseWrapper;

/**
 * Repository for handling consumer invoices (Facturas de Consumo) with DGII.
 *
 * This class serves as a data source for the external DGII API endpoints
 * related to the submission and status lookup of consumer invoices.
 */
class DgiiConsumeInvoiceRepository
{
    /**
     * Create a new class instance.
     *
     * @param  DgiiResponseWrapper  $dgiiResponseWrapper  Service to wrap and standardize DGII responses.
     */
    public function __construct(
        protected DgiiResponseWrapper $dgiiResponseWrapper,
    ) {
        //
    }

    /**
     * Send the consumer invoice XML to DGII.
     *
     * @param  string  $token  The authentication token obtained from DGII.
     * @param  string  $filePath  The absolute path to the signed XML file on disk.
     * @param  string|null  $env  The target DGII environment (testecf, certecf, ecf).
     * @return InvoiceReceived The response object containing DGII submission details and status.
     *
     * @throws ConnectionException
     */
    public function send(string $token, string $filePath, ?string $env = null): InvoiceReceived
    {
        // Wrap the execution to capture both response data and HTTP status
        [$response, $status] = $this->dgiiResponseWrapper->wrap(function () use ($token, $filePath, $env) {
            // Build and execute the HTTP request to DGII
            return Http::dgiiFc($env)
                ->withToken($token)
                ->attachXml($filePath)
                ->post(config('dgii.endpoints.fc.send'))
                ->json();
        });

        // Return the processed response DTO
        return new InvoiceReceived($response, $status);
    }

    /**
     * Find a consumer invoice status in DGII by its XML data.
     *
     * @param  string  $token  The authentication token obtained from DGII.
     * @param  InvoiceXml  $xml  The invoice XML object containing identification data.
     * @param  string|null  $env  The target DGII environment (testecf, certecf, ecf).
     * @return InvoiceReceived The response object containing DGII status details.
     *
     * @throws ConnectionException
     */
    public function find(string $token, InvoiceXml $xml, ?string $env = null): InvoiceReceived
    {
        // Wrap the execution to capture both response data and HTTP status
        [$response, $status] = $this->dgiiResponseWrapper->wrap(function () use ($token, $xml, $env) {
            // Build and execute the HTTP request to DGII with identification parameters
            return Http::dgiiFc($env)
                ->withToken($token)
                ->get(config('dgii.endpoints.fc.status'), [
                    'RNC_Emisor' => $xml->getSenderIdentification(),
                    'ENCF' => $xml->getSequenceNumber(),
                    'Cod_Seguridad_eCF' => $xml->getSecurityCode(),
                ])
                ->json();
        });

        // Return the processed response DTO
        return new InvoiceReceived($response, $status);
    }
}
