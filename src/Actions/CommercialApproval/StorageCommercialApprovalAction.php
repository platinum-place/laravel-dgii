<?php

namespace PlatinumPlace\LaravelDgii\Actions\CommercialApproval;

use PlatinumPlace\LaravelDgii\Actions\Invoice\GenerateInvoiceQrLinkAction;
use PlatinumPlace\LaravelDgii\Support\StorageService;
use PlatinumPlace\LaravelDgii\ValueObjects\CommercialApproval\CommercialApprovalXml;
use PlatinumPlace\LaravelDgii\ValueObjects\CommercialApproval\StoredCommercialApproval;

class StorageCommercialApprovalAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected StorageService              $storageService,
        protected GenerateInvoiceQrLinkAction $generateInvoiceQrLinkAction
    )
    {
        //
    }

    public function handle(string $signedXml): StoredCommercialApproval
    {
        $commercialApprovalXml = new CommercialApprovalXml($signedXml);

        $commercialApprovalXmlPath = $this->storageService->putXml($signedXml, $commercialApprovalXml->getXmlName());

        return new StoredCommercialApproval($commercialApprovalXml, $commercialApprovalXmlPath);
    }
}
