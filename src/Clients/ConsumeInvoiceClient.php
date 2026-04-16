<?php

namespace PlatinumPlace\LaravelDgii\Clients;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use PlatinumPlace\LaravelDgii\Helpers\StorageHelper;
use PlatinumPlace\LaravelDgii\ValueObjects\InvoiceXml;

/**
 * Cliente para interactuar con los servicios web de la DGII.
 *
 * Esta clase centraliza todas las peticiones HTTP a los diferentes endpoints de la DGII
 * para el manejo de comprobantes fiscales electrónicos (e-CF), incluyendo autenticación,
 * envío de documentos y consultas de estado.
 */
class ConsumeInvoiceClient
{
    /**
     * Crea una nueva instancia del cliente.
     *
     * @param  StorageHelper  $storageHelper  Ayudante para interactuar con el almacenamiento de archivos.
     */
    public function __construct(protected StorageHelper $storageHelper)
    {
        //
    }

    /**
     * Envía una Factura de Consumo Electrónica (RFCE) a la DGII.
     *
     * @param  string  $token  Token de autenticación vigente.
     * @param  string  $xmlPath  Ruta relativa del archivo XML firmado del RFCE.
     * @param  string|null  $env  El ambiente (testecf, certecf, ecf).
     * @return array Respuesta de la DGII con el trackId.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function send(string $token, string $xmlPath, ?string $env = null): array
    {
        $filePath = $this->storageHelper->path($xmlPath);

        $env ??= config('dgii.environment');

        $url = sprintf(
            '%s/%s/recepcionfc/api/recepcion/ecf',
            config('dgii.domains.fc'),
            $env
        );

        return Http::withToken($token)
            ->attach('xml', fopen($filePath, 'r'), basename($xmlPath))
            ->post($url)
            ->throw()
            ->json();
    }

    /**
     * Genera el enlace para la consulta del timbre (QR) de una Factura de Consumo.
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
     * Consulta el estado de una Factura de Consumo (RFCE).
     *
     * @param  string  $token  Token de autenticación vigente.
     * @param  InvoiceXml  $invoiceXml  Objeto de valor del XML de la factura.
     * @param  string|null  $env  El ambiente (testecf, certecf, ecf).
     * @return array Detalle del estado de la factura de consumo.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetchStatus(string $token, InvoiceXml $invoiceXml, ?string $env = null): array
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
}
