<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use PlatinumPlace\LaravelDgii\Clients\DgiiClient;
use PlatinumPlace\LaravelDgii\Helpers\StorageHelper;
use PlatinumPlace\LaravelDgii\ValueObjects\InvoiceXml;

class GenerateInvoiceQrLinkAction
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
     * Generar la URL completa del timbre fiscal para la consulta pública de la factura.
     * Esta URL es la que se debe incluir en el código QR del PDF.
     *
     * @param string $xmlPath Ruta relativa del archivo XML firmado.
     * @param string|null $env Ambiente de ejecución.
     * @return string URL de consulta (ej: https://ecf.dgii.gov.do/.../ConsultaTimbre?...)
     */
    public function handle(string $xmlPath, ?string $env = null): string
    {
        $xml = $this->storageHelper->get($xmlPath);

        $invoiceXml = new InvoiceXml($xml);

        return $invoiceXml->isConsumeInvoice()
            ? $this->client->fetchConsumerInvoiceQRLink($invoiceXml, $env)
            : $this->client->fetchInvoiceQRLink($invoiceXml, $env);
    }
}
