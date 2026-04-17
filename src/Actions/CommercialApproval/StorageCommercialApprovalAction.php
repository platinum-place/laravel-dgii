<?php

namespace PlatinumPlace\LaravelDgii\Actions\CommercialApproval;

use PlatinumPlace\LaravelDgii\Actions\Invoice\GenerateInvoiceQrLinkAction;
use PlatinumPlace\LaravelDgii\Support\StorageService;
use PlatinumPlace\LaravelDgii\ValueObjects\CommercialApproval\CommercialApprovalXml;

class StorageCommercialApprovalAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected StorageService $storageService,
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

        return $this->storageService->putXml($signedXml, $commercialApprovalXml->getXmlName());
    }
}
