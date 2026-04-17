<?php

namespace PlatinumPlace\LaravelDgii\Clients;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use PlatinumPlace\LaravelDgii\Support\StorageService;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceXml;

/**
 * Cliente para interactuar con los servicios web de la DGII.
 *
 * Esta clase centraliza todas las peticiones HTTP a los diferentes endpoints de la DGII
 * para el manejo de comprobantes fiscales electrónicos (e-CF), incluyendo autenticación,
 * envío de documentos y consultas de estado.
 */
class InvoiceClient
{
    /**
     * Crea una nueva instancia del cliente.
     *
     * @param  StorageService  $storageService  Ayudante para interactuar con el almacenamiento de archivos.
     */
    public function __construct(protected StorageService $storageService)
    {
        //
    }

    /**
     * Envía una factura electrónica (e-CF) a la DGII.
     *
     * @param  string  $token  Token de autenticación vigente.
     * @param  string  $xmlPath  Ruta relativa del archivo XML firmado del e-CF.
     * @param  string|null  $env  El ambiente (testecf, certecf, ecf).
     * @return array Respuesta de la DGII con el trackId o errores de validación.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function send(string $token, string $xmlPath, ?string $env = null): array
    {
        $filePath = $this->storageService->path($xmlPath);

        $env ??= config('dgii.environment');

        $url = sprintf(
            '%s/%s/recepcion/api/facturaselectronicas',
            config('dgii.domains.ecf'),
            $env
        );

        return Http::withToken($token)
            ->attach('xml', fopen($filePath, 'r'), basename($xmlPath))
            ->post($url)
            ->throw()
            ->json();
    }

    /**
     * Consulta el estado de una recepción de e-CF mediante su TrackId.
     *
     * @param  string  $token  Token de autenticación vigente.
     * @param  string  $trackId  El ID de seguimiento devuelto en el envío.
     * @param  string|null  $env  El ambiente (testecf, certecf, ecf).
     * @return array Detalle del estado del documento enviado.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetchStatusByTrackId(string $token, string $trackId, ?string $env = null): array
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
     * Consulta el historial de TrackIds asociados a un e-CF específico.
     *
     * @param  string  $token  Token de autenticación vigente.
     * @param  InvoiceXml  $invoiceXml  Objeto de valor del XML de la factura.
     * @param  string|null  $env  El ambiente (testecf, certecf, ecf).
     * @return array Lista de TrackIds y sus estados.
     *
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

    /**
     * Genera el enlace para la consulta del timbre (QR) de un e-CF.
     *
     * @param  InvoiceXml  $invoiceXml  Objeto de valor del XML de la factura.
     * @param  string|null  $env  El ambiente (testecf, certecf, ecf).
     * @return string URL completa para el código QR.
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
            'ConsultaTimbre',
            http_build_query($parameters)
        );
    }

    /**
     * Consulta el estado actual de un e-CF.
     *
     * @param  string  $token  Token de autenticación vigente.
     * @param  InvoiceXml  $invoiceXml  Objeto de valor del XML de la factura.
     * @param  string|null  $env  El ambiente (testecf, certecf, ecf).
     * @return array Detalle del estado del documento.
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
            '%s/%s/consultaestado/api/consultas/estado',
            config('dgii.domains.ecf'),
            $env
        );

        return Http::withToken($token)
            ->get($url, $parameters)
            ->throw()
            ->json();
    }
}
