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
class SeedClient
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
     * Obtiene el XML de la semilla para el proceso de autenticación.
     *
     * @param  string|null  $env  El ambiente (testecf, certecf, ecf). Si es nulo, usa el configurado.
     * @return string El contenido XML de la semilla.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetch(?string $env = null): string
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
     * Envía la semilla firmada para obtener un token de acceso (JWT).
     *
     * @param  string  $xmlPath  Ruta relativa del archivo XML de la semilla firmada.
     * @param  string|null  $env  El ambiente (testecf, certecf, ecf).
     * @return array Respuesta de la DGII con el token y su expiración.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function fetchToken(string $xmlPath, ?string $env = null): array
    {
        $filePath = $this->storageHelper->path($xmlPath);

        $env ??= config('dgii.environment');

        $url = sprintf(
            '%s/%s/autenticacion/api/autenticacion/validarsemilla',
            config('dgii.domains.ecf'),
            $env
        );

        return Http::attach('xml', fopen($filePath, 'r'), basename($xmlPath))
            ->post($url)
            ->throw()
            ->json();
    }
}
