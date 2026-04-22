<?php

namespace PlatinumPlace\LaravelDgii\Clients;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

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
     */
    public function __construct()
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
        $env ??= config('dgii.environment');

        $url = sprintf(
            '%s/%s/%s',
            config('dgii.domains.fc'),
            $env,
            config('dgii.endpoints.fc.send')
        );

        return Http::withToken($token)
            ->attach('xml', fopen($xmlPath, 'rb'), basename($xmlPath))
            ->post($url)
            ->throw()
            ->json();
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetchStatus(
        string $token,
        string $senderIdentification,
        string $sequenceNumber,
        string $securityCode,
        ?string $env = null
    ): array {
        $env ??= config('dgii.environment');

        $url = sprintf(
            '%s/%s/%s',
            config('dgii.domains.fc'),
            $env,
            config('dgii.endpoints.fc.status')
        );

        return Http::withToken($token)
            ->get($url, [
                'RNC_Emisor' => $senderIdentification,
                'ENCF' => $sequenceNumber,
                'Cod_Seguridad_eCF' => $securityCode,
            ])
            ->throw()
            ->json();
    }

    /**
     * Generate the link for the QR stamp verification for consumption invoices.
     *
     * @param  string  $senderIdentification  Sender identification number.
     * @param  string  $sequenceNumber  Sequence number of the invoice.
     * @param  string  $totalAmount  Total amount of the invoice.
     * @param  string  $securityCode  Security code of the invoice.
     * @param  string  $releaseDate  Release date of the invoice.
     * @param  string  $signatureDate  Signature date of the invoice.
     * @param  string|null  $buyerIdentification  Optional buyer identification number.
     * @param  string|null  $env  The environment (testecf, certecf, ecf).
     * @return string Full URL for the QR code.
     */
    public function fetchQRLink(
        string $senderIdentification,
        string $sequenceNumber,
        string $totalAmount,
        string $securityCode,
        string $releaseDate,
        string $signatureDate,
        ?string $buyerIdentification = null,
        ?string $env = null
    ): string {
        $env ??= config('dgii.environment');

        $parameters = [
            'RncEmisor' => $senderIdentification,
            'ENCF' => $sequenceNumber,
            'MontoTotal' => $totalAmount,
            'CodigoSeguridad' => $securityCode,
            'FechaEmision' => $releaseDate,
            'FechaFirma' => $signatureDate,
        ];

        if ($buyerIdentification) {
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
