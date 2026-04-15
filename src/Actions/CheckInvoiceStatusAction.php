<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use PlatinumPlace\LaravelDgii\Clients\DgiiClient;
use PlatinumPlace\LaravelDgii\Helpers\StorageHelper;
use PlatinumPlace\LaravelDgii\ValueObjects\InvoiceXml;

class CheckInvoiceStatusAction
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
     * Consultar el estado de un e-CF enviado previamente a la DGII.
     *
     * @param string $xmlPath Ruta relativa del archivo XML en el disco configurado.
     * @param string|null $trackId ID de seguimiento retornado por la DGII en el envío.
     * @param string|null $env Ambiente de ejecución.
     * @param string|null $certPath Ruta absoluta al certificado para autenticación.
     * @param string|null $certPassword Contraseña del certificado.
     * @return array Respuesta con el estado detallado de la factura.
     * @throws ConnectionException|RequestException
     */
    public function handle(string $xmlPath, ?string $trackId = null, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): array
    {
        $token = $this->authenticateAction->handle($env, $certPath, $certPassword);

        $xml = $this->storageHelper->get($xmlPath);

        $invoiceXml = new InvoiceXml($xml);

        return $invoiceXml->isConsumeInvoice()
            ? $this->client->fetchConsumerInvoiceStatus($token, $invoiceXml, $env)
            : $this->client->fetchInvoiceStatusByTrackId($token, $trackId, $env);
    }
}
