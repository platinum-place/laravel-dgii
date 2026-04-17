<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Cache;
use PlatinumPlace\LaravelDgii\Actions\Seed\ReceiveSeedAction;
use PlatinumPlace\LaravelDgii\Clients\SeedClient;
use PlatinumPlace\LaravelDgii\Support\StorageService;
use PlatinumPlace\LaravelDgii\Support\XmlSigner;

class AuthenticateAction
{
    /**
     * Crea una nueva instancia para la acción de autenticación.
     *
     * @param  SeedClient  $seedClient  Cliente de semillas.
     * @param  XmlSigner  $xmlSigner  Servicio de firmado de XML.
     * @param  StorageService  $storageService  Servicio de almacenamiento.
     * @param  ReceiveSeedAction  $receiveSeedAction  Acción para recibir semillas.
     */
    public function __construct(
        protected SeedClient $seedClient,
        protected XmlSigner $xmlSigner,
        protected StorageService $storageService,
        protected ReceiveSeedAction $receiveSeedAction
    ) {
        //
    }

    /**
     * Realizar el proceso de obtención de un nuevo token (Semilla -> Firma -> Validar).
     *
     * @return array Datos del token incluyendo su expiración.
     *
     * @throws ConnectionException|RequestException
     */
    private function refreshToken(?string $env = null, ?string $certPath = null, ?string $certPassword = null): array
    {
        $xml = $this->seedClient->fetch($env);

        $signedXml = $this->xmlSigner->sign($xml, $certPath, $certPassword);

        return $this->receiveSeedAction->handle($signedXml, $env);
    }

    /**
     * Obtener un token de autenticación válido para los servicios de la DGII.
     * El token se almacena en caché para optimizar el rendimiento y evitar solicitudes innecesarias.
     *
     * @param  string|null  $env  Ambiente de ejecución.
     * @param  string|null  $certPath  Ruta absoluta al certificado.
     * @param  string|null  $certPassword  Contraseña del certificado.
     * @return string Token de autenticación (Bearer).
     *
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
}
