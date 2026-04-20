<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoice;

use PlatinumPlace\LaravelDgii\Support\StorageService;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceXml;

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
     * Store the signed Invoice XML(s) and return their stored paths.
     *
     * @param  InvoiceXml  $invoiceXml  The signed main invoice XML.
     * @param  InvoiceXml|null  $integralInvoiceXml  The signed integral invoice XML (for consumer summary).
     * @return array An array containing [string $invoiceXmlPath, ?string $integralInvoiceXmlPath].
     */
    public function handle(InvoiceXml $invoiceXml, ?InvoiceXml $integralInvoiceXml = null): array
    {
        $invoiceXmlPath = $this->storageService->putXml($invoiceXml->xmlContent, $invoiceXml->getXmlName());

        $integralInvoiceXmlPath = null;

        if ($integralInvoiceXml) {
            $integralInvoiceXmlPath = $this->storageService->putXml($integralInvoiceXml->xmlContent, $integralInvoiceXml->getXmlName());
        }

        return [$invoiceXmlPath, $integralInvoiceXmlPath];
    }
}
