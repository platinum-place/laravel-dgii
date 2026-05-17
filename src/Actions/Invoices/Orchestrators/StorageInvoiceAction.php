<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoices\Orchestrators;

use PlatinumPlace\LaravelDgii\Actions\Invoices\ResolveInvoiceQrLinkAction;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceData;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;

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

    public function handle(string $signed, ?string $env = null): InvoiceData
    {
        $object = new InvoiceXml($signed);

        $path = $this->storage->save($signed, $object->getXmlName());

        $qrLink = $this->qrResolver->handle($object, $env);

        return new InvoiceData($object, $path, $qrLink);
    }
}
