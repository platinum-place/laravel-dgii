<?php

namespace PlatinumPlace\LaravelDgii\Support;

use PlatinumPlace\DgiiXmlSigner\SignManager;

class XmlSigner
{
    /**
     * Crea una nueva instancia para el firmado de XML.
     *
     * @param  StorageService  $storageService  Servicio de almacenamiento.
     */
    public function __construct(protected StorageService $storageService)
    {
        //
    }

    /**
     * Firmar digitalmente un contenido XML utilizando el certificado configurado.
     *
     * @param  string  $xml  Contenido XML plano a firmar.
     * @param  string|null  $certPath  Ruta al certificado (si se desea sobrescribir el de config).
     * @param  string|null  $certPassword  Contraseña del certificado.
     * @return string XML firmado digitalmente.
     */
    public function sign(string $xml, ?string $certPath = null, ?string $certPassword = null): string
    {
        return (new SignManager)->sign(
            $this->storageService->get($certPath ?? config('dgii.certificate')),
            $certPassword ?? config('dgii.certificate_password'),
            $xml
        );
    }
}
