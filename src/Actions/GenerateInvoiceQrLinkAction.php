<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use PlatinumPlace\LaravelDgii\Clients\ConsumeInvoiceClient;
use PlatinumPlace\LaravelDgii\Clients\InvoiceClient;
use PlatinumPlace\LaravelDgii\Helpers\StorageHelper;
use PlatinumPlace\LaravelDgii\ValueObjects\InvoiceXml;

class GenerateInvoiceQrLinkAction
{
    /**
     * Create a new class instance.
     *
     * @param  DgiiClient  $client
     */
    public function __construct(
        protected StorageHelper $storageHelper,
        protected InvoiceClient $invoiceClient,
        protected ConsumeInvoiceClient $consumeInvoiceClient,
    ) {
        //
    }

    /**
     * Generar la URL completa del timbre fiscal para la consulta pública de la factura.
     * Esta URL es la que se debe incluir en el código QR del PDF.
     *
     * @param  string  $xmlPath  Ruta relativa del archivo XML firmado.
     * @param  string|null  $env  Ambiente de ejecución.
     * @return string URL de consulta (ej: https://ecf.dgii.gov.do/.../ConsultaTimbre?...)
     */
    public function handle(string $xmlPath, ?string $env = null): string
    {
        $xml = $this->storageHelper->get($xmlPath);

        $invoiceXml = new InvoiceXml($xml);

        return $invoiceXml->isConsumeInvoice()
            ? $this->consumeInvoiceClient->fetchQRLink($invoiceXml, $env)
            : $this->invoiceClient->fetchQRLink($invoiceXml, $env);
    }
}
