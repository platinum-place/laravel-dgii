<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceData;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;
use PlatinumPlace\LaravelDgii\Services\DgiiQrResolver;

/**
 * Class StorageInvoiceAction
 *
 * This action is used to store an already signed XML string into the
 * project's storage system. It handles the persistence and ensures
 * that the QR link is generated for the stored document.
 */
class StorageInvoiceAction
{
    /**
     * Create a new storage invoice action instance.
     */
    public function __construct(
        protected StorageRepository $storage,
        protected DgiiQrResolver $qrResolver,
    ) {
        //
    }

    /**
     * Handle the storage of a signed XML.
     *
     * Execution Flow:
     * 1. Instantiate: Create an InvoiceXml object from the signed string.
     * 2. Store: Save the signed XML string to the storage disk.
     * 3. QR Resolver: Generate the URL for the invoice's QR code.
     */
    public function handle(string $signed, ?string $env = null): InvoiceData
    {
        $object = new InvoiceXml($signed);

        $path = $this->storage->save($signed,$object->getXmlName());

        $qrLink = $this->qrResolver->getInvoiceQrLink($object, $env);

        return new InvoiceData($object, $path, $qrLink);
    }
}
