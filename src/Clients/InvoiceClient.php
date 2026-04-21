<?php

namespace PlatinumPlace\LaravelDgii\Clients;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use PlatinumPlace\LaravelDgii\Support\StorageService;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceXml;

/**
 * Client to interact with DGII e-CF (Electronic Invoice) Services.
 *
 * This class handles the transmission of signed e-CF documents and
 * provides methods to query their status and tracking information.
 */
class InvoiceClient
{
    /**
     * Create a new client instance.
     *
     * @param  StorageService  $storageService  Helper to interact with file storage.
     */
    public function __construct(protected StorageService $storageService)
    {
        //
    }

    /**
     * Send an electronic invoice (e-CF) to DGII.
     *
     * @param  string  $token  Valid authentication token.
     * @param  string  $xmlPath  Relative path of the signed e-CF XML file.
     * @param  string|null  $env  The environment (testecf, certecf, ecf).
     * @return array DGII response with trackId or validation errors.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function send(string $token, string $xmlPath, ?string $env = null): array
    {
        $filePath = $this->storageService->path($xmlPath);

        $env ??= config('dgii.environment');

        $url = sprintf(
            '%s/%s/%s',
            config('dgii.domains.ecf'),
            $env,
            config('dgii.endpoints.invoice.send')
        );

        return Http::withToken($token)
            ->attach('xml', fopen($filePath, 'rb'), basename($xmlPath))
            ->post($url)
            ->throw()
            ->json();
    }

    /**
     * Fetch the status of an e-CF reception using its TrackId.
     *
     * @param  string  $token  Valid authentication token.
     * @param  string  $trackId  The tracking ID returned during submission.
     * @param  string|null  $env  The environment (testecf, certecf, ecf).
     * @return array Details of the submitted document status.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetchStatusByTrackId(string $token, string $trackId, ?string $env = null): array
    {
        $env ??= config('dgii.environment');

        $url = sprintf(
            '%s/%s/%s',
            config('dgii.domains.ecf'),
            $env,
            config('dgii.endpoints.invoice.status')
        );

        return Http::withToken($token)
            ->get($url, ['trackid' => $trackId])
            ->throw()
            ->json();
    }

    /**
     * Fetch the history of TrackIds associated with a specific e-CF.
     *
     * @param  string  $token  Valid authentication token.
     * @param  InvoiceXml  $invoiceXml  Invoice XML value object.
     * @param  string|null  $env  The environment (testecf, certecf, ecf).
     * @return array List of TrackIds and their statuses.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetchTrackIdList(string $token, InvoiceXml $invoiceXml, ?string $env = null): array
    {
        $env ??= config('dgii.environment');

        $url = sprintf(
            '%s/%s/%s',
            config('dgii.domains.ecf'),
            $env,
            config('dgii.endpoints.invoice.trackids')
        );

        return Http::withToken($token)
            ->get($url, [
                'RncEmisor' => $invoiceXml->getSenderIdentification(),
                'Encf' => $invoiceXml->getSequenceNumber(),
            ])
            ->throw()
            ->json();
    }

    /**
     * Generate the link for the QR stamp verification.
     *
     * @param  InvoiceXml  $invoiceXml  Invoice XML value object.
     * @param  string|null  $env  The environment (testecf, certecf, ecf).
     * @return string Full URL for the QR code.
     */
    public function fetchQRLink(InvoiceXml $invoiceXml, ?string $env = null): string
    {
        $env ??= config('dgii.environment');

        $parameters = [
            'RncEmisor' => $invoiceXml->getSenderIdentification(),
            'ENCF' => $invoiceXml->getSequenceNumber(),
            'MontoTotal' => $invoiceXml->getTotalAmount(),
            'CodigoSeguridad' => $invoiceXml->getSecurityCode(),
            'FechaEmision' => $invoiceXml->getReleaseDate(),
            'FechaFirma' => $invoiceXml->getSignatureDate(),
        ];

        if ($buyerIdentification = $invoiceXml->getBuyerIdentification()) {
            $parameters['RncComprador'] = $buyerIdentification;
        }

        return sprintf(
            '%s/%s/%s?%s',
            config('dgii.domains.ecf'),
            $env,
            config('dgii.endpoints.invoice.timbre'),
            http_build_query($parameters)
        );
    }

    /**
     * Query the current status of an e-CF.
     *
     * @param  string  $token  Valid authentication token.
     * @param  InvoiceXml  $invoiceXml  Invoice XML value object.
     * @param  string|null  $env  The environment (testecf, certecf, ecf).
     * @return array Details of the document status.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetchStatus(string $token, InvoiceXml $invoiceXml, ?string $env = null): array
    {
        $env ??= config('dgii.environment');

        $parameters = [
            'RncEmisor' => $invoiceXml->getSenderIdentification(),
            'NcfElectronico' => $invoiceXml->getSequenceNumber(),
        ];

        if ($buyerIdentification = $invoiceXml->getBuyerIdentification()) {
            $parameters['RncComprador'] = $buyerIdentification;
        }

        if ($securityCode = $invoiceXml->getSecurityCode()) {
            $parameters['CodigoSeguridad'] = $securityCode;
        }

        $url = sprintf(
            '%s/%s/%s',
            config('dgii.domains.ecf'),
            $env,
            config('dgii.endpoints.invoice.check')
        );

        return Http::withToken($token)
            ->get($url, $parameters)
            ->throw()
            ->json();
    }
}
