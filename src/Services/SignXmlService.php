<?php

namespace PlatinumPlace\LaravelDgii\Services;

use PlatinumPlace\DgiiXmlSigner\SignManager;
use PlatinumPlace\LaravelDgii\Helpers\StorageHelper;

class SignXmlService
{
    /**
     * Create a new class instance.
     *
     * @param StorageHelper $storageHelper
     */
    public function __construct(protected StorageHelper $storageHelper)
    {
        //
    }

    /**
     * Firmar digitalmente un contenido XML utilizando el certificado configurado.
     *
     * @param string $xml Contenido XML plano a firmar.
     * @param string|null $certPath Ruta al certificado (si se desea sobrescribir el de config).
     * @param string|null $certPassword Contraseña del certificado.
     * @return string XML firmado digitalmente.
     */
    public function handle(string $xml, ?string $certPath = null, ?string $certPassword = null): string
    {
        return (new SignManager)->sign(
            $this->storageHelper->get($certPath ?? config('dgii.certificate')),
            $certPassword ?? config('dgii.certificate_password'),
            $xml
        );
    }
}
