<?php

namespace PlatinumPlace\LaravelDgii\Data;

use PlatinumPlace\LaravelDgii\ValueObjects\Acknowledgment\StoredAcknowledgment;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceReceived;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\StoredInvoice;

class InvoiceData
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public StoredInvoice        $storedInvoice,
        public InvoiceReceived      $invoiceReceived,
        public StoredAcknowledgment $storedAcknowledgment,
    )
    {
        //
    }
}
