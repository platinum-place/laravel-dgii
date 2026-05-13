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

    public function sign(string $xml, ?string $certPath = null, ?string $certPassword = null): string
    {
        return $this->signXml->handle($xml, $certPath, $certPassword);
    }

    public function validateCertificate(?string $certPath = null, ?string $certPassword = null): array
    {
        return $this->validateCertificate->handle($certPath, $certPassword);
    }
}
