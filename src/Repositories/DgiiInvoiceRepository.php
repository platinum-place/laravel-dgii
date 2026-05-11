<?php

namespace PlatinumPlace\LaravelDgii\Repositories;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceResponse;
use PlatinumPlace\LaravelDgii\Exceptions\DgiiInvoiceRepositoryException;
use PlatinumPlace\LaravelDgii\Services\DgiiResponseWrapper;

/**
 * Repository for handling standard electronic invoices (e-CF) with DGII.
 *
 * This class serves as a data source for the external DGII API endpoints
 * related to the submission and tracking of standard tax documents.
 */
class DgiiInvoiceRepository
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
     * Send an electronic invoice (e-CF) XML to DGII.
     *
     * @param  string  $token  The authentication token obtained from DGII.
     * @param  string  $filePath  The absolute path to the signed XML file on disk.
     * @param  string|null  $env  The target DGII environment (testecf, certecf, ecf).
     * @return InvoiceResponse The response object containing DGII submission details and status.
     *
     * @throws ConnectionException
     */
    public function send(string $token, string $filePath, ?string $env = null): InvoiceResponse
    {
        // Wrap the execution to capture both response data and HTTP status
        [$response, $status] = $this->dgiiResponseWrapper->wrap(function () use ($token, $filePath, $env) {
            // Build and execute the HTTP request to DGII
            return Http::dgiiEcf($env)
                ->withToken($token)
                ->attachXml($filePath)
                ->post(config('dgii.endpoints.invoice.send'))
                ->json() ?? throw new DgiiInvoiceRepositoryException('Error enviando la factura electrónica (e-CF) a la DGII.');
        });

        // Return the processed response DTO
        return new InvoiceResponse($response, $status);
    }

    /**
     * Find the status of an e-CF in DGII by its Track ID.
     *
     * @param  string  $token  The authentication token obtained from DGII.
     * @param  string  $trackId  The tracking identifier returned by DGII upon submission.
     * @param  string|null  $env  The target DGII environment (testecf, certecf, ecf).
     * @return InvoiceResponse The response object containing DGII status details.
     *
     * @throws ConnectionException
     */
    public function findByTrackId(string $token, string $trackId, ?string $env = null): InvoiceResponse
    {
        // Wrap the execution to capture both response data and HTTP status
        [$response, $status] = $this->dgiiResponseWrapper->wrap(function () use ($token, $trackId, $env) {
            // Build and execute the HTTP request to DGII with the track ID
            return Http::dgiiEcf($env)
                ->withToken($token)
                ->get(config('dgii.endpoints.invoice.status'), [
                    'trackid' => $trackId,
                ])
                ->json() ?? throw new DgiiInvoiceRepositoryException('Error consultando el estado de la factura por Track ID.');
        });

        // Return the processed response DTO
        return new InvoiceResponse($response, $status);
    }

    /**
     * Retrieve all Track IDs associated with a specific sender and sequence number.
     *
     * @param  string  $token  The authentication token obtained from DGII.
     * @param  string  $senderIdentification  The RNC of the document issuer.
     * @param  string  $sequenceNumber  The unique e-CF sequence number (eNCF).
     * @param  string|null  $env  The target DGII environment (testecf, certecf, ecf).
     * @return array List of Track IDs and their associated metadata from DGII.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function all(string $token, string $senderIdentification, string $sequenceNumber, ?string $env = null): array
    {
        // Build and execute the HTTP request to DGII to fetch track history
        return Http::dgiiEcf($env)
            ->withToken($token)
            ->get(config('dgii.endpoints.invoice.trackids'), [
                'RncEmisor' => $senderIdentification,
                'Encf' => $sequenceNumber,
            ])
            ->json() ?? throw new DgiiInvoiceRepositoryException('Error obteniendo el historial de Track IDs de la factura.');
    }
}
