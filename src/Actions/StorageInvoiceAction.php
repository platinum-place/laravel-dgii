<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use PlatinumPlace\LaravelDgii\Data\InvoiceData;
use PlatinumPlace\LaravelDgii\Helpers\StorageHelper;
use PlatinumPlace\LaravelDgii\ValueObjects\InvoiceXml;

class StorageInvoiceAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected StorageHelper $storageHelper, protected GenerateInvoiceQrLinkAction $generateInvoiceQrLinkAction)
    {
        //
    }

    public function handle(string $signedXml, ?string $env = null, ?InvoiceData $integralInvoice = null): InvoiceData
    {
        $invoiceXml = new InvoiceXml($signedXml);

        $xmlPath = $this->storageHelper->putXml($signedXml, $invoiceXml->getXmlName());

        return new InvoiceData(
            $invoiceXml,
            $xmlPath,
            $this->generateInvoiceQrLinkAction->handle($xmlPath, $env),
            $integralInvoice
        );
    }
}