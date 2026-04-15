<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Cache;
use PlatinumPlace\LaravelDgii\Clients\DgiiClient;
use PlatinumPlace\LaravelDgii\Helpers\StorageHelper;
use PlatinumPlace\LaravelDgii\Services\SignXmlService;

class AuthenticateAction
{
    /**
     * Create a new class instance.
     *
     * @param DgiiClient $client
     * @param SignXmlService $signXml
     * @param StorageHelper $storageHelper
     * @param ReceiveSeedAction $receiveSeedAction
     */
    public function __construct(
        protected DgiiClient $client,
        protected SignXmlService $signXml,
        protected StorageHelper $storageHelper,
        protected ReceiveSeedAction $receiveSeedAction
    ) {
        //
    }

    /**
     * Obtener un token de autenticación válido para los servicios de la DGII.
     * El token se almacena en caché para optimizar el rendimiento y evitar solicitudes innecesarias.
     *
     * @param string|null $env Ambiente de ejecución.
     * @param string|null $certPath Ruta absoluta al certificado.
     * @param string|null $certPassword Contraseña del certificado.
     * @return string Token de autenticación (Bearer).
     * @throws ConnectionException|RequestException
     */
    public function handle(?string $env = null, ?string $certPath = null, ?string $certPassword = null): string
    {
        $cacheKey = config('dgii.cache.prefix').md5($certPath.$env);

        if ($token = Cache::get($cacheKey)) {
            return $token;
        }

        $response = $this->refreshToken($env, $certPath, $certPassword);

        $ttl = max(1, (strtotime($response['expira']) - now()->timestamp) - config('dgii.cache.buffer'));

        Cache::put($cacheKey, $response['token'], $ttl);

        return $response['token'];
    }

    /**
     * Realizar el proceso de obtención de un nuevo token (Semilla -> Firma -> Validar).
     *
     * @param string|null $env
     * @param string|null $certPath
     * @param string|null $certPassword
     * @return array Datos del token incluyendo su expiración.
     * @throws ConnectionException|RequestException
     */
    private function refreshToken(?string $env = null, ?string $certPath = null, ?string $certPassword = null): array
    {
        $xml = $this->client->fetchAuthXml($env);

        $signedXml = $this->signXml->handle($xml, $certPath, $certPassword);

        return $this->receiveSeedAction->handle($signedXml, $env);
    }
}
