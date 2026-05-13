<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoices\Orchestrators;

use PlatinumPlace\LaravelDgii\Actions\Invoices\ResolveInvoiceQrLinkAction;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceData;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;

/**
 * Orchestrates the persistence and QR resolution of a signed invoice.
 */
class StorageInvoiceAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected StorageRepository $storage,
        protected ResolveInvoiceQrLinkAction $qrResolver,
    ) {
        //
    }

    /**
     * Save a signed XML string and resolve its QR link.
     *
     * Flow:
     * 1. Initialize the InvoiceXml object from the signed string.
     * 2. Save the signed XML to the local storage.
     * 3. Resolve the QR link for the invoice.
     */
    public function handle(string $signed, ?string $env = null): InvoiceData
    {
        $object = new InvoiceXml($signed);

        $path = $this->storage->save($signed, $object->getXmlName());

        $qrLink = $this->qrResolver->handle($object, $env);

        return new InvoiceData($object, $path, $qrLink);
    }
}
