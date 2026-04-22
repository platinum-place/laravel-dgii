<?php

namespace PlatinumPlace\LaravelDgii\Clients;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

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
     */
    public function __construct()
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
        $env ??= config('dgii.environment');

        $url = sprintf(
            '%s/%s/%s',
            config('dgii.domains.ecf'),
            $env,
            config('dgii.endpoints.invoice.send')
        );

        return Http::withToken($token)
            ->attach('xml', fopen($xmlPath, 'rb'), basename($xmlPath))
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
     * @param  string  $senderIdentification  Sender identification number.
     * @param  string  $sequenceNumber  Sequence number of the invoice.
     * @param  string|null  $env  The environment (testecf, certecf, ecf).
     * @return array List of TrackIds and their statuses.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetchTrackIdList(string $token, string $senderIdentification, string $sequenceNumber, ?string $env = null): array
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
                'RncEmisor' => $senderIdentification,
                'Encf' => $sequenceNumber,
            ])
            ->throw()
            ->json();
    }

    /**
     * Generate the link for the QR stamp verification.
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
     * @param  string  $senderIdentification  Sender identification number.
     * @param  string  $sequenceNumber  Electronic NCF (Sequence number).
     * @param  string|null  $buyerIdentification  Optional buyer identification number.
     * @param  string|null  $securityCode  Optional security code.
     * @param  string|null  $env  The environment (testecf, certecf, ecf).
     * @return array Details of the document status.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetchStatus(
        string $token,
        string $senderIdentification,
        string $sequenceNumber,
        ?string $buyerIdentification = null,
        ?string $securityCode = null,
        ?string $env = null
    ): array {
        $env ??= config('dgii.environment');

        $parameters = [
            'RncEmisor' => $senderIdentification,
            'NcfElectronico' => $sequenceNumber,
        ];

        if ($buyerIdentification) {
            $parameters['RncComprador'] = $buyerIdentification;
        }

        if ($securityCode) {
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
