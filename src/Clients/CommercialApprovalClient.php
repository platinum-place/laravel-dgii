<?php

namespace PlatinumPlace\LaravelDgii\Clients;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use PlatinumPlace\LaravelDgii\Helpers\StorageHelper;

/**
 * Cliente para interactuar con los servicios web de la DGII.
 *
 * Esta clase centraliza todas las peticiones HTTP a los diferentes endpoints de la DGII
 * para el manejo de comprobantes fiscales electrónicos (e-CF), incluyendo autenticación,
 * envío de documentos y consultas de estado.
 */
class CommercialApprovalClient
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
     * Envía una aprobación comercial de un e-CF recibido.
     *
     * @param  string  $token  Token de autenticación vigente.
     * @param  string  $xmlPath  Ruta relativa del archivo XML de la aprobación.
     * @param  string|null  $env  El ambiente (testecf, certecf, ecf).
     * @return array Respuesta de la DGII sobre el envío.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function send(string $token, string $xmlPath, ?string $env = null): array
    {
        $filePath = $this->storageHelper->path($xmlPath);

        $env ??= config('dgii.environment');

        $url = sprintf(
            '%s/%s/aprobacioncomercial/api/aprobacioncomercial',
            config('dgii.domains.ecf'),
            $env
        );

        return Http::withToken($token)
            ->attach('xml', fopen($filePath, 'r'), basename($xmlPath))
            ->post($url)
            ->throw()
            ->json();
    }
}
