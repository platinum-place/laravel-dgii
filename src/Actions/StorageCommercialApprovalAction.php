<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use PlatinumPlace\LaravelDgii\Helpers\StorageHelper;
use PlatinumPlace\LaravelDgii\ValueObjects\CommercialApprovalXml;

class StorageCommercialApprovalAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected StorageHelper $storageHelper,
        protected GenerateInvoiceQrLinkAction $generateInvoiceQrLinkAction
    ) {
        //
    }

    /**
     * Almacenar el XML de aprobación comercial firmado en el disco configurado.
     *
     * @param  string  $signedXml  Contenido del XML firmado.
     * @return string Ruta relativa del archivo guardado.
     */
    public function handle(string $signedXml): string
    {
        $commercialApprovalXml = new CommercialApprovalXml($signedXml);

        return $this->storageHelper->putXml($signedXml, $commercialApprovalXml->getXmlName());
    }
}
