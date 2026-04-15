<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use Illuminate\Support\Facades\View;
use PlatinumPlace\LaravelDgii\Data\InvoiceData;
use PlatinumPlace\LaravelDgii\Services\SignXmlService;

class SignInvoiceAction
{
    /**
     * Create a new class instance.
     *
     * @param SignXmlService $signXml
     * @param StorageInvoiceAction $storageInvoiceAction
     */
    public function __construct(protected SignXmlService $signXml, protected StorageInvoiceAction $storageInvoiceAction)
    {
        //
    }

    /**
     * Firmar un e-CF (Comprobante Fiscal Electrónico).
     *
     * @param array $data Datos estructurados de la factura.
     * @param string|null $env Ambiente de ejecución (testecf, certecf, ecf).
     * @param string|null $certPath Ruta absoluta al certificado .p12.
     * @param string|null $certPassword Contraseña del certificado.
     * @return InvoiceData
     */
    private function signEcf(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        $xml = View::make('dgii::ecf.ecf_'.$data['IdDoc']['TipoeCF'], $data)->render();

        $signedXml = $this->signXml->handle($xml, $certPath, $certPassword);

        return $this->storageInvoiceAction->handle($signedXml, $env);
    }

    /**
     * Firmar un RFCE (Resumen de Factura de Consumo Electrónica).
     *
     * @param InvoiceData $ecf Instancia del e-CF base ya firmado.
     * @param array $data Datos estructurados de la factura.
     * @param string|null $env Ambiente de ejecución.
     * @param string|null $certPath Ruta absoluta al certificado.
     * @param string|null $certPassword Contraseña del certificado.
     * @return InvoiceData
     */
    private function signRfce(InvoiceData $ecf, array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        $data['CodigoSeguridadeCF'] = $ecf->xml->getSecurityCode();

        $xml = View::make('dgii::rfce.xml', $data)->render();

        $signedXml = $this->signXml->handle($xml, $certPath, $certPassword);

        return $this->storageInvoiceAction->handle($signedXml, $env, $ecf);
    }

    /**
     * Orquestar el proceso de firma de una factura.
     * Detecta automáticamente si debe generar un RFCE adicional para facturas de consumo.
     *
     * @param array $data Datos estructurados de la factura.
     * @param string|null $env Ambiente de ejecución.
     * @param string|null $certPath Ruta absoluta al certificado.
     * @param string|null $certPassword Contraseña del certificado.
     * @return InvoiceData
     */
    public function handle(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        $ecf = $this->signEcf($data, $env, $certPath, $certPassword);

        if ($ecf->xml->isConsumeInvoice()) {
            return $this->signRfce($ecf, $data, $env, $certPath, $certPassword);
        }

        return $ecf;
    }
}
