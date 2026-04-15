<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use Illuminate\Support\Facades\View;
use PlatinumPlace\LaravelDgii\Helpers\StorageHelper;
use PlatinumPlace\LaravelDgii\Services\SignXmlService;

class SignAcknowledgmentAction
{
    /**
     * Create a new class instance.
     *
     * @param SignXmlService $signXml
     * @param StorageHelper $storageHelper
     */
    public function __construct(protected SignXmlService $signXml, protected StorageHelper $storageHelper)
    {
        //
    }

    /**
     * Generar y firmar el XML de Acuse de Recibo (ARECF) para un comprobante recibido.
     *
     * @param array $data Datos para la plantilla ARECF.
     * @param string|null $certPath Ruta al certificado.
     * @param string|null $certPassword Contraseña del certificado.
     * @return string Ruta relativa del XML firmado y almacenado.
     */
    public function handle(array $data, ?string $certPath = null, ?string $certPassword = null): string
    {
        $xml = View::make('dgii::arecf.xml', $data)->render();

        $signedXml = $this->signXml->handle($xml, $certPath, $certPassword);

        return $this->storageHelper->putXml($signedXml);
    }
}
