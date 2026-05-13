<?php

namespace PlatinumPlace\LaravelDgii\Services;

use PlatinumPlace\LaravelDgii\Actions\Xmls\Orchestrators\SignXmlAction;
use PlatinumPlace\LaravelDgii\Actions\Xmls\Orchestrators\ValidateCertificateAction;

class XmlService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected SignXmlAction $signXml,
        protected ValidateCertificateAction $validateCertificate,
    ) {
        //
    }

    /**
     * Firma un contenido XML utilizando el certificado digital.
     *
     * @param  string  $xml  El contenido XML a firmar.
     * @param  string|null  $certPath  Ruta al certificado digital (opcional).
     * @param  string|null  $certPassword  Contraseña del certificado (opcional).
     * @return string El XML firmado.
     *
     * @throws \InvalidArgumentException
     */
    public function sign(string $xml, ?string $certPath = null, ?string $certPassword = null): string
    {
        return $this->signXml->handle($xml, $certPath, $certPassword);
    }

    /**
     * Valida la integridad y vigencia de un certificado digital.
     *
     * @param  string|null  $certPath  Ruta al certificado digital (opcional).
     * @param  string|null  $certPassword  Contraseña del certificado (opcional).
     * @return array Información de validación del certificado.
     *
     * @throws \InvalidArgumentException
     */
    public function validateCertificate(?string $certPath = null, ?string $certPassword = null): array
    {
        return $this->validateCertificate->handle($certPath, $certPassword);
    }
}
