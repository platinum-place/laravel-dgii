<?php

namespace PlatinumPlace\LaravelDgii\Clients;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use PlatinumPlace\LaravelDgii\Support\StorageService;

/**
 * Cliente para interactuar con los servicios web de la DGII.
 *
 * Esta clase centraliza todas las peticiones HTTP a los diferentes endpoints de la DGII
 * para el manejo de comprobantes fiscales electrónicos (e-CF), incluyendo autenticación,
 * envío de documentos y consultas de estado.
 */
class DgiiClient
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
     * Obtiene el estado general de los servicios web de la DGII.
     *
     * @return array Lista de servicios y sus respectivos estados de disponibilidad.
     *
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
            'Authorization' => 'Apikey '.config('dgii.api_key'),
        ])
            ->get($url)
            ->throw()
            ->json();
    }

    /**
     * Obtiene las ventanas de mantenimiento programadas por la DGII.
     *
     * @return array Lista de ventanas de mantenimiento.
     *
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
            'Authorization' => 'Apikey '.config('dgii.api_key'),
        ])
            ->get($url)
            ->throw()
            ->json();
    }

    /**
     * Verifica el estado de un ambiente específico (Producción, Pruebas, Certificación).
     *
     * @param  string|null  $env  El ambiente a verificar. Si es nulo, usa el configurado.
     * @return array Estado del ambiente solicitado.
     *
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
            'Authorization' => 'Apikey '.config('dgii.api_key'),
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
