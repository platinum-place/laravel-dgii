<?php

namespace PlatinumPlace\LaravelDgii\Actions\CancellationRange;

use Illuminate\Support\Facades\View;
use PlatinumPlace\LaravelDgii\Support\StorageService;
use PlatinumPlace\LaravelDgii\Support\XmlSigner;

class SignCancellationRangeAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected XmlSigner $xmlSigner,
        protected StorageService $storageService
    ) {
        //
    }

    /**
     * Generar y firmar el XML de Anulación de Rango de Secuencias (ANECF).
     *
     * @param  array  $data  Datos para la plantilla de anulación.
     * @param  string|null  $certPath  Ruta al certificado.
     * @param  string|null  $certPassword  Contraseña del certificado.
     * @return string Ruta relativa del XML de anulación firmado.
     */
    public function handle(array $data, ?string $certPath = null, ?string $certPassword = null): string
    {
        $xml = View::make('dgii::anecf.xml', $data)->render();

        $signedXml = $this->xmlSigner->sign($xml, $certPath, $certPassword);

        return $this->storageService->putXml($signedXml);
    }
}
