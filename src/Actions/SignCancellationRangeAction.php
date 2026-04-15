<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use Illuminate\Support\Facades\View;
use PlatinumPlace\LaravelDgii\Helpers\StorageHelper;
use PlatinumPlace\LaravelDgii\Services\SignXmlService;

class SignCancellationRangeAction
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
     * Generar y firmar el XML de Anulación de Rango de Secuencias (ANECF).
     *
     * @param array $data Datos para la plantilla de anulación.
     * @param string|null $certPath Ruta al certificado.
     * @param string|null $certPassword Contraseña del certificado.
     * @return string Ruta relativa del XML de anulación firmado.
     */
    public function handle(array $data, ?string $certPath = null, ?string $certPassword = null): string
    {
        $xml = View::make('dgii::anecf.xml', $data)->render();

        $signedXml = $this->signXml->handle($xml, $certPath, $certPassword);

        return $this->storageHelper->putXml($signedXml);
    }
}
