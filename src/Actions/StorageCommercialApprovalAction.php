<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use PlatinumPlace\LaravelDgii\Data\InvoiceData;
use PlatinumPlace\LaravelDgii\Helpers\StorageHelper;
use PlatinumPlace\LaravelDgii\ValueObjects\CommercialApprovalXml;

class StorageCommercialApprovalAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected StorageHelper $storageHelper, protected GenerateInvoiceQrLinkAction $generateInvoiceQrLinkAction)
    {
        //
    }

    public function handle(string $signedXml): string
    {
        $commercialApprovalXml = new CommercialApprovalXml($signedXml);

       return $this->storageHelper->putXml($signedXml, $commercialApprovalXml->getXmlName());
    }
}