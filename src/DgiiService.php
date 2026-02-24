<?php

namespace PlatinumPlace\LaravelDgii;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class DgiiService
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
    public function fetchToken(string $filePath, ?string $env = null): array
    {
        $env ??= config('dgii.environment');

        $url = sprintf(
            '%s/%s/autenticacion/api/autenticacion/validarsemilla',
            config('dgii.domains.ecf'),
            $env
        );

        return Http::attach('xml', fopen($filePath, 'r'), basename($filePath))
            ->post($url)
            ->throw()
            ->json();
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function sendInvoice(string $token, string $filePath, ?string $env = null): array
    {
        $env ??= config('dgii.environment');

        $url = sprintf(
            '%s/%s/recepcion/api/facturaselectronicas',
            config('dgii.domains.ecf'),
            $env
        );

        return Http::withToken($token)
            ->attach('xml', fopen($filePath, 'r'), basename($filePath))
            ->post($url)
            ->throw()
            ->json();
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function sendCommercialApproval(string $token, string $filePath, ?string $env = null): array
    {
        $env ??= config('dgii.environment');

        $url = sprintf(
            '%s/%s/aprobacioncomercial/api/aprobacioncomercial',
            config('dgii.domains.ecf'),
            $env
        );

        return Http::withToken($token)
            ->attach('xml', fopen($filePath, 'r'), basename($filePath))
            ->post($url)
            ->throw()
            ->json();
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function sendCancellationRange(string $token, string $filePath, ?string $env = null): array
    {
        $env ??= config('dgii.environment');

        $url = sprintf(
            '%s/%s/anulacionrangos/api/operaciones/anularrango',
            config('dgii.domains.ecf'),
            $env
        );

        return Http::withToken($token)
            ->attach('xml', fopen($filePath, 'r'), basename($filePath))
            ->post($url)
            ->throw()
            ->json();
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getInvoiceStatusByTrackId(string $token, string $trackId, ?string $env = null): array
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
    public function getTrackIdList(string $token, string $xmlContent, ?string $env = null): array
    {
        $xmlObject = new DgiiXmlHelper($xmlContent);
        $env ??= config('dgii.environment');

        $url = sprintf(
            '%s/%s/consultatrackids/api/trackids/consulta',
            config('dgii.domains.ecf'),
            $env
        );

        return Http::withToken($token)
            ->get($url, [
                'RncEmisor' => $xmlObject->getSenderIdentification(),
                'Encf' => $xmlObject->getSequenceNumber(),
            ])
            ->throw()
            ->json();
    }

    public function getInvoiceQRLink(string $xmlContent, ?string $env = null): string
    {
        $xmlObject = new DgiiXmlHelper($xmlContent);
        $env ??= config('dgii.environment');

        $parameters = [
            'RncEmisor' => $xmlObject->getSenderIdentification(),
            'ENCF' => $xmlObject->getSequenceNumber(),
            'MontoTotal' => $xmlObject->getInvoiceTotal(),
            'CodigoSeguridad' => $xmlObject->getSecurityCode(),
            'FechaEmision' => $xmlObject->getReleaseDate(),
            'FechaFirma' => $xmlObject->getSignatureDate(),
        ];

        if ($buyerIdentification = $xmlObject->getBuyerIdentification()) {
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
    public function sendConsumerInvoice(string $token, string $filePath, ?string $env = null): array
    {
        $env ??= config('dgii.environment');

        $url = sprintf(
            '%s/%s/recepcionfc/api/recepcion/ecf',
            config('dgii.domains.fc'),
            $env
        );

        return Http::withToken($token)
            ->attach('xml', fopen($filePath, 'r'), basename($filePath))
            ->post($url)
            ->throw()
            ->json();
    }

    public function getConsumerInvoiceQRLink(string $xmlContent, ?string $env = null): string
    {
        $xmlObject = new DgiiXmlHelper($xmlContent);
        $env ??= config('dgii.environment');

        $parameters = [
            'RncEmisor' => $xmlObject->getSenderIdentification(),
            'ENCF' => $xmlObject->getSequenceNumber(),
            'MontoTotal' => $xmlObject->getInvoiceTotal(),
            'CodigoSeguridad' => $xmlObject->getSecurityCode(),
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
    public function getConsumerInvoiceStatus(string $token, string $xmlContent, ?string $env = null): array
    {
        $xmlObject = new DgiiXmlHelper($xmlContent);
        $env ??= config('dgii.environment');

        $url = sprintf(
            '%s/%s/consultarfce/api/Consultas/Consulta',
            config('dgii.domains.fc'),
            $env
        );

        return Http::withToken($token)
            ->get($url, [
                'RNC_Emisor' => $xmlObject->getSenderIdentification(),
                'ENCF' => $xmlObject->getSequenceNumber(),
                'Cod_Seguridad_eCF' => $xmlObject->getSecurityCode(),
            ])
            ->throw()
            ->json();
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getInvoiceStatus(string $token, string $xmlContent, ?string $env = null): array
    {
        $xmlObject = new DgiiXmlHelper($xmlContent);
        $env ??= config('dgii.environment');

        $parameters = [
            'RncEmisor' => $xmlObject->getSenderIdentification(),
            'NcfElectronico' => $xmlObject->getSequenceNumber(),
        ];

        if ($buyerIdentification = $xmlObject->getBuyerIdentification()) {
            $parameters['RncComprador'] = $buyerIdentification;
        }

        if ($securityCode = $xmlObject->getSecurityCode()) {
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
                'ambiente' => $env,
            ])
            ->throw()
            ->json();
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function submitInvoice(string $token, string $filePath, ?string $env = null): array
    {
        $xmlContent = file_get_contents($filePath);
        $xmlObject = new DgiiXmlHelper($xmlContent);

        return $xmlObject->isConsumeInvoice()
            ? $this->sendConsumerInvoice($token, $filePath, $env)
            : $this->sendInvoice($token, $filePath, $env);
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetchInvoice(string $token, string $filePath, ?string $env = null): array
    {
        $xmlContent = file_get_contents($filePath);
        $xmlObject = new DgiiXmlHelper($xmlContent);

        return $xmlObject->isConsumeInvoice()
            ? $this->getConsumerInvoiceStatus($token, $xmlContent, $env)
            : $this->getInvoiceStatus($token, $xmlContent, $env);
    }

    public function getInvoiceLink(string $filePath, ?string $env = null): string
    {
        $xmlContent = file_get_contents($filePath);
        $xmlObject = new DgiiXmlHelper($xmlContent);

        return $xmlObject->isConsumeInvoice()
            ? $this->getConsumerInvoiceQRLink($xmlContent, $env)
            : $this->getInvoiceQRLink($xmlContent, $env);
    }
}
