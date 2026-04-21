<?php

namespace PlatinumPlace\LaravelDgii\Clients;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use PlatinumPlace\LaravelDgii\Support\StorageService;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceXml;

/**
 * Client to interact with DGII Consumption Invoice Services (RFCE).
 *
 * This class handles the transmission of Consumer Electronic Invoices
 * to the specific DGII endpoints for this type of document.
 */
class ConsumeInvoiceClient
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
     * Send a Consumer Electronic Invoice (RFCE) to DGII.
     *
     * @param  string  $token  Valid authentication token.
     * @param  string  $xmlPath  Relative path of the signed RFCE XML file.
     * @param  string|null  $env  The environment (testecf, certecf, ecf).
     * @return array DGII response with trackId.
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
            config('dgii.domains.fc'),
            $env,
            config('dgii.endpoints.fc.send')
        );

        return Http::withToken($token)
            ->attach('xml', fopen($filePath, 'rb'), basename($xmlPath))
            ->post($url)
            ->throw()
            ->json();
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetchStatus(string $token, InvoiceXml $invoiceXml, ?string $env = null): array
    {
        $env ??= config('dgii.environment');

        $url = sprintf(
            '%s/%s/%s',
            config('dgii.domains.fc'),
            $env,
            config('dgii.endpoints.fc.status')
        );

        return Http::withToken($token)
            ->get($url, [
                'RNC_Emisor' => $invoiceXml->getSenderIdentification(),
                'ENCF' => $invoiceXml->getSequenceNumber(),
                'Cod_Seguridad_eCF' => $invoiceXml->getSecurityCode(),
            ])
            ->throw()
            ->json();
    }

    /**
     * Generate the link for the QR stamp verification for consumption invoices.
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
            config('dgii.domains.fc'),
            $env,
            config('dgii.endpoints.fc.timbre'),
            http_build_query($parameters)
        );
    }
}
