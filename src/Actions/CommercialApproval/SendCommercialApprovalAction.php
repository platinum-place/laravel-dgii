<?php

namespace PlatinumPlace\LaravelDgii\Actions\CommercialApproval;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use PlatinumPlace\LaravelDgii\Actions\AuthenticateAction;
use PlatinumPlace\LaravelDgii\Clients\CommercialApprovalClient;

class SendCommercialApprovalAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected AuthenticateAction $authenticateAction,
        protected CommercialApprovalClient $commercialApprovalClient
    ) {
        //
    }

    /**
     * Enviar el XML de aprobación comercial firmado a la DGII.
     *
     * @param  string  $xmlPath  Ruta relativa del XML de aprobación comercial.
     * @param  string|null  $env  Ambiente de ejecución.
     * @param  string|null  $certPath  Ruta absoluta al certificado para autenticación.
     * @param  string|null  $certPassword  Contraseña del certificado.
     * @return array Respuesta de la DGII.
     *
     * @throws ConnectionException|RequestException
     */
    public function handle(string $xmlPath, ?string $env = null, ?string $certPath = null, ?string $certPassword = null, ?string $token = null): array
    {
        if(!$token){
            $token = $this->authenticateAction->handle($env, $certPath, $certPassword);
        }

        return $this->commercialApprovalClient->send($token, $xmlPath, $env);
    }
}
