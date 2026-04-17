<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoice;

use PlatinumPlace\LaravelDgii\Clients\ConsumeInvoiceClient;
use PlatinumPlace\LaravelDgii\Clients\InvoiceClient;
use PlatinumPlace\LaravelDgii\Support\StorageService;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceXml;

class GenerateInvoiceQrLinkAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected StorageService $storageService,
        protected InvoiceClient $invoiceClient,
        protected ConsumeInvoiceClient $consumeInvoiceClient,
    ) {
        //
    }

    /**
     * Generar la URL completa del timbre fiscal para la consulta pública de la factura.
     * Esta URL es la que se debe incluir en el código QR del PDF.
     *
     * @param  string|InvoiceXml  $invoiceXml  Ruta relativa del archivo XML firmado o objeto de valor del XML.
     * @param  string|null  $env  Ambiente de ejecución.
     * @return string URL de consulta (ej: https://ecf.dgii.gov.do/.../ConsultaTimbre?...)
     */
    public function handle(string|InvoiceXml $invoiceXml, ?string $env = null): string
    {
        if (is_string($invoiceXml)) {
            $invoiceXml = new InvoiceXml(
                $this->storageService->get($invoiceXml)
            );
        }

        return $invoiceXml->isConsumeInvoice()
            ? $this->consumeInvoiceClient->fetchQRLink($invoiceXml, $env)
            : $this->invoiceClient->fetchQRLink($invoiceXml, $env);
    }
}
