<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use PlatinumPlace\LaravelDgii\Clients\DgiiClient;
use PlatinumPlace\LaravelDgii\Helpers\StorageHelper;
use PlatinumPlace\LaravelDgii\ValueObjects\InvoiceXml;

class SendInvoiceAction
{
    /**
     * Create a new class instance.
     *
     * @param AuthenticateAction $authenticateAction
     * @param DgiiClient $client
     * @param StorageHelper $storageHelper
     */
    public function __construct(
        protected AuthenticateAction $authenticateAction,
        protected DgiiClient $client,
        protected StorageHelper $storageHelper
    ) {
        //
    }

    /**
     * Enviar una factura electrónica (o un resumen de consumo) a la DGII.
     * Gestiona automáticamente la autenticación para obtener el token necesario.
     *
     * @param string $xmlPath Ruta relativa del archivo XML en el disco configurado.
     * @param string|null $env Ambiente de ejecución.
     * @param string|null $certPath Ruta absoluta al certificado para autenticación.
     * @param string|null $certPassword Contraseña del certificado.
     * @return array Respuesta de la DGII (usualmente contiene el trackId).
     * @throws ConnectionException|RequestException
     */
    public function handle(string $xmlPath, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): array
    {
        $token = $this->authenticateAction->handle($env, $certPath, $certPassword);

        $xml = $this->storageHelper->get($xmlPath);

        $invoiceXml = new InvoiceXml($xml);

        return $invoiceXml->isConsumeInvoice()
            ? $this->client->sendConsumerInvoice($token, $xmlPath, $env)
            : $this->client->sendInvoice($token, $xmlPath, $env);
    }
}
