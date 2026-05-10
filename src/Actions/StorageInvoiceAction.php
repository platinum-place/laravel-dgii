<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceData;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;
use PlatinumPlace\LaravelDgii\Services\DgiiQrResolver;

class StorageInvoiceAction
{
    /**
     * Create a new validate certificate action instance.
     */
    public function __construct(
        protected StorageRepository $storage,
        protected DgiiQrResolver $qrResolver,
    ) {
        //
    }

    public function handle(string $signed, ?string $env = null): InvoiceData
    {
        $object = new InvoiceXml($signed);

        $path = $this->storage->save($signed);

        $qrLink = $this->qrResolver->getInvoiceQrLink($object, $env);

        return new InvoiceData(
            $object,
            $path,
            $qrLink,
            null,
            null,
            null,
            null,
        );
    }
}
