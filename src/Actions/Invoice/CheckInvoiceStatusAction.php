<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoice;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use PlatinumPlace\LaravelDgii\Actions\AuthenticateAction;
use PlatinumPlace\LaravelDgii\Clients\ConsumeInvoiceClient;
use PlatinumPlace\LaravelDgii\Clients\InvoiceClient;
use PlatinumPlace\LaravelDgii\Support\StorageService;
use PlatinumPlace\LaravelDgii\Traits\Invoices\HasResponse;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceReceived;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceXml;

class CheckInvoiceStatusAction
{
    use HasResponse;

    /**
     * Create a new class instance.
     */
    public function __construct(
        protected AuthenticateAction $authenticateAction,
        protected StorageService $storageService,
        protected InvoiceClient $invoiceClient,
        protected ConsumeInvoiceClient $consumeInvoiceClient,
    ) {
        //
    }

    /**
     * Consultar el estado de un e-CF enviado previamente a la DGII.
     *
     * @param  string  $xmlPath  Ruta relativa del archivo XML en el disco configurado.
     * @param  string|null  $trackId  ID de seguimiento retornado por la DGII en el envío.
     * @param  string|null  $env  Ambiente de ejecución.
     * @param  string|null  $certPath  Ruta absoluta al certificado para autenticación.
     * @param  string|null  $certPassword  Contraseña del certificado.
     * @return InvoiceReceived Respuesta con el estado detallado de la factura.
     *
     * @throws ConnectionException|RequestException
     */
    public function handle(string $xmlPath, ?string $trackId = null, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceReceived
    {
        $token = $this->authenticateAction->handle($env, $certPath, $certPassword);

        $xml = $this->storageService->get($xmlPath);

        $invoiceXml = new InvoiceXml($xml);

        return $this->catchResponse(fn () => $invoiceXml->isConsumeInvoice()
            ? $this->consumeInvoiceClient->fetchStatus($token, $invoiceXml, $env)
            : $this->invoiceClient->fetchStatusByTrackId($token, $trackId, $env));
    }
}
