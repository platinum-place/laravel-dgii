<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoice;

use PlatinumPlace\LaravelDgii\Data\Invoice\SignedInvoice;
use PlatinumPlace\LaravelDgii\Data\Invoice\StoredInvoice;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;

/**
 * Action to persist signed Invoice XML(s) to storage.
 */
class StorageInvoiceAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected StorageRepository $storageRepository)
    {
        //
    }

    public function handle(SignedInvoice $signedInvoice): StoredInvoice
    {
        $invoiceXml = $signedInvoice->invoiceXml;

        $invoiceXmlPath = $this->storageRepository->save($invoiceXml->xmlContent, $invoiceXml->getXmlName());

        $integralInvoiceXmlPath = null;

        if ($integralInvoiceXml = $signedInvoice->integralInvoiceXml) {
            $integralInvoiceXmlPath = $this->storageRepository->save($integralInvoiceXml->xmlContent, $integralInvoiceXml->getXmlName());
        }

        return new StoredInvoice($invoiceXmlPath, $integralInvoiceXmlPath);
    }
}
