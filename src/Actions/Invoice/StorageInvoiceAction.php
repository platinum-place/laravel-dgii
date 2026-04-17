<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoice;

use PlatinumPlace\LaravelDgii\Support\StorageService;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\SignedInvoice;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\StoredInvoice;

/**
 * Action to persist signed Invoice XML(s) to storage.
 */
class StorageInvoiceAction
{
    /**
     * Create a new class instance.
     *
     * @param  StorageService  $storageService  Storage service instance.
     */
    public function __construct(protected StorageService $storageService)
    {
        //
    }

    /**
     * Store the signed Invoice XML(s) and return the stored data object.
     *
     * @param  SignedInvoice  $signedInvoice  The signed invoice object.
     * @return StoredInvoice Stored invoice with file paths.
     */
    public function handle(SignedInvoice $signedInvoice): StoredInvoice
    {
        $invoiceXmlPath = $this->storageService->putXml($signedInvoice->invoiceXml->xmlContent, $signedInvoice->invoiceXml->getXmlName());

        $integralInvoiceXmlPath = null;

        if ($signedInvoice->integralInvoiceXml) {
            $integralInvoiceXmlPath = $this->storageService->putXml($signedInvoice->integralInvoiceXml->xmlContent, $signedInvoice->integralInvoiceXml->getXmlName());
        }

        return new StoredInvoice($signedInvoice, $invoiceXmlPath, $integralInvoiceXmlPath);
    }
}
