<?php

namespace PlatinumPlace\LaravelDgii\Clients;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use PlatinumPlace\LaravelDgii\DgiiXmlHelper;
use PlatinumPlace\LaravelDgii\ValueObjects\InvoiceXml;

class DgiiClient
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetchAuthXml(?string $env = null): string
    {
        $env ??= config('dgii.environment');

        $url = sprintf(
            '%s/%s/autenticacion/api/autenticacion/semilla',
            config('dgii.domains.ecf'),
            $env
        );

        return Http::get($url)
            ->throw()
            ->body();
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetchToken(string $xmlPath, ?string $env = null): array
    {
        $env ??= config('dgii.environment');

        $url = sprintf(
            '%s/%s/autenticacion/api/autenticacion/validarsemilla',
            config('dgii.domains.ecf'),
            $env
        );

        return Http::attach('xml', fopen($xmlPath, 'r'), basename($xmlPath))
            ->post($url)
            ->throw()
            ->json();
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function sendInvoice(string $token, string $xmlPath, ?string $env = null): array
    {
        $env ??= config('dgii.environment');

        $url = sprintf(
            '%s/%s/recepcion/api/facturaselectronicas',
            config('dgii.domains.ecf'),
            $env
        );

        return Http::withToken($token)
            ->attach('xml', fopen($xmlPath, 'r'), basename($xmlPath))
            ->post($url)
            ->throw()
            ->json();
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function sendCommercialApproval(string $token, string $xmlPath, ?string $env = null): array
    {
        $env ??= config('dgii.environment');

        $url = sprintf(
            '%s/%s/aprobacioncomercial/api/aprobacioncomercial',
            config('dgii.domains.ecf'),
            $env
        );

        return Http::withToken($token)
            ->attach('xml', fopen($xmlPath, 'r'), basename($xmlPath))
            ->post($url)
            ->throw()
            ->json();
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function sendCancellationRange(string $token, string $xmlPath, ?string $env = null): array
    {
        $env ??= config('dgii.environment');

        $url = sprintf(
            '%s/%s/anulacionrangos/api/operaciones/anularrango',
            config('dgii.domains.ecf'),
            $env
        );

        return Http::withToken($token)
            ->attach('xml', fopen($xmlPath, 'r'), basename($xmlPath))
            ->post($url)
            ->throw()
            ->json();
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetchInvoiceStatusByTrackId(string $token, string $trackId, ?string $env = null): array
    {
        $env ??= config('dgii.environment');

        $url = sprintf(
            '%s/%s/consultaresultado/api/consultas/estado',
            config('dgii.domains.ecf'),
            $env
        );

        return Http::withToken($token)
            ->get($url, ['trackid' => $trackId])
            ->throw()
            ->json();
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetchTrackIdList(string $token, InvoiceXml $invoiceXml, ?string $env = null): array
    {
        $env ??= config('dgii.environment');

        $url = sprintf(
            '%s/%s/consultatrackids/api/trackids/consulta',
            config('dgii.domains.ecf'),
            $env
        );

        return Http::withToken($token)
            ->get($url, [
                'RncEmisor' => $invoiceXml->getSenderIdentification(),
                'Encf' => $invoiceXml->getSequenceNumber(),
            ])
            ->throw()
            ->json();
    }

    public function fetchInvoiceQRLink(InvoiceXml $invoiceXml, ?string $env = null): string
    {
        $env ??= config('dgii.environment');

        $parameters = [
            'RncEmisor' => $invoiceXml->getSenderIdentification(),
            'ENCF' => $invoiceXml->getSequenceNumber(),
            'MontoTotal' => $invoiceXml->getInvoiceTotal(),
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
            'ConsultaTimbre',
            http_build_query($parameters)
        );
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function sendConsumerInvoice(string $token, string $xmlPath, ?string $env = null): array
    {
        $env ??= config('dgii.environment');

        $url = sprintf(
            '%s/%s/recepcionfc/api/recepcion/ecf',
            config('dgii.domains.fc'),
            $env
        );

        return Http::withToken($token)
            ->attach('xml', fopen($xmlPath, 'r'), basename($xmlPath))
            ->post($url)
            ->throw()
            ->json();
    }

    public function fetchConsumerInvoiceQRLink(InvoiceXml $invoiceXml, ?string $env = null): string
    {
        $env ??= config('dgii.environment');

        $parameters = [
            'RncEmisor' => $invoiceXml->getSenderIdentification(),
            'ENCF' => $invoiceXml->getSequenceNumber(),
            'MontoTotal' => $invoiceXml->getInvoiceTotal(),
            'CodigoSeguridad' => $invoiceXml->getSecurityCode(),
        ];

        return sprintf(
            '%s/%s/%s?%s',
            config('dgii.domains.fc'),
            $env,
            'ConsultaTimbreFC',
            http_build_query($parameters)
        );
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetchConsumerInvoiceStatus(string $token, InvoiceXml $invoiceXml, ?string $env = null): array
    {
        $env ??= config('dgii.environment');

        $url = sprintf(
            '%s/%s/consultarfce/api/Consultas/Consulta',
            config('dgii.domains.fc'),
            $env
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
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetchInvoiceStatus(string $token, InvoiceXml $invoiceXml, ?string $env = null): array
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
            '%s/%s/consultaestado/api/consultas/estado',
            config('dgii.domains.ecf'),
            $env
        );

        return Http::withToken($token)
            ->get($url, $parameters)
            ->throw()
            ->json();
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetchServiceStatus(): array
    {
        $url = sprintf(
            '%s/api/estatusservicios/obtenerestatus',
            config('dgii.domains.statusecf'),
        );

        return Http::withHeaders([
            'accept' => '*/*',
            'Authorization' => 'Apikey ' . config('dgii.api_key'),
        ])
            ->get($url)
            ->throw()
            ->json();
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetchMaintenanceWindows(): array
    {
        $url = sprintf(
            '%s/api/estatusservicios/obtenerventanasmantenimiento',
            config('dgii.domains.statusecf'),
        );

        return Http::withHeaders([
            'accept' => '*/*',
            'Authorization' => 'Apikey ' . config('dgii.api_key'),
        ])
            ->get($url)
            ->throw()
            ->json();
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetchEnvironmentStatus(?string $env = null): array
    {
        $env ??= config('dgii.environment');
        $url = sprintf(
            '%s/api/estatusservicios/verificarestado',
            config('dgii.domains.statusecf'),
        );

        return Http::withHeaders([
            'accept' => '*/*',
            'Authorization' => 'Apikey ' . config('dgii.api_key'),
        ])
            ->get($url, [
                'ambiente' => match ($env) {
                   'testecf' => 1,
                   'ecf' => 2,
                   'certecf' => 3,
                   default => 1,
                },
            ])
            ->throw()
            ->json();
    }
}
