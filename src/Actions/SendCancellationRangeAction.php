<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use PlatinumPlace\LaravelDgii\Clients\DgiiClient;

class SendCancellationRangeAction
{
    /**
     * Create a new class instance.
     *
     * @param AuthenticateAction $authenticateAction
     * @param DgiiClient $client
     */
    public function __construct(protected AuthenticateAction $authenticateAction, protected DgiiClient $client)
    {
        //
    }

    /**
     * Enviar el XML de anulación de rango de secuencias firmado a la DGII.
     *
     * @param string $xmlPath Ruta relativa del XML de anulación firmado.
     * @param string|null $env Ambiente de ejecución.
     * @param string|null $certPath Ruta absoluta al certificado para autenticación.
     * @param string|null $certPassword Contraseña del certificado.
     * @return array Respuesta de la DGII.
     * @throws \Illuminate\Http\Client\ConnectionException|\Illuminate\Http\Client\RequestException
     */
    public function handle(string $xmlPath, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): array
    {
        $token = $this->authenticateAction->handle($env, $certPath, $certPassword);

        return $this->client->sendCancellationRange($token, $xmlPath, $env);
    }
}
