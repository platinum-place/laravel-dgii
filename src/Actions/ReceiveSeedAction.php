<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use PlatinumPlace\LaravelDgii\Clients\DgiiClient;
use PlatinumPlace\LaravelDgii\Helpers\StorageHelper;

class ReceiveSeedAction
{
    /**
     * Create a new class instance.
     *
     * @param DgiiClient $client
     * @param StorageHelper $storageHelper
     */
    public function __construct(protected DgiiClient $client, protected StorageHelper $storageHelper)
    {
        //
    }

    /**
     * Validar la semilla firmada ante la DGII para obtener un token de acceso.
     *
     * @param string $signedXml Contenido del XML de la semilla firmado.
     * @param string|null $env Ambiente de ejecución.
     * @return array Datos de la respuesta (token, fecha de expiración).
     * @throws \Illuminate\Http\Client\ConnectionException|\Illuminate\Http\Client\RequestException
     */
    public function handle(string $signedXml, ?string $env = null): array
    {
        $xmlPath = $this->storageHelper->putXml($signedXml, 'semilla');

        return $this->client->fetchToken($xmlPath, $env);
    }
}
