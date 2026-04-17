<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoice;

use PlatinumPlace\LaravelDgii\Support\StorageService;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\SignedInvoice;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\StoredInvoice;

class StorageInvoiceAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected StorageService $storageService)
    {
        //
    }

    public function handle(SignedInvoice $signedInvoice): StoredInvoice
    {
        $invoiceXmlPath = $this->storageService->putXml($signedInvoice->invoiceXml->xmlContent, $signedInvoice->invoiceXml->getXmlName());

        $integralInvoiceXmlPath = null;

        if ($signedInvoice->integralInvoiceXml) {
            $integralInvoiceXmlPath = $this->storageService->putXml($signedInvoice->invoiceXml->xmlContent, $signedInvoice->invoiceXml->getXmlName());
        }

        return new StoredInvoice($signedInvoice, $invoiceXmlPath, $integralInvoiceXmlPath);
    }
}
