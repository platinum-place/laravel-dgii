<?php

namespace PlatinumPlace\LaravelDgii\Data;

use PlatinumPlace\LaravelDgii\ValueObjects\Acknowledgment\StoredAcknowledgment;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceReceived;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\StoredInvoice;

/**
 * Data Transfer Object containing the complete lifecycle data of an e-CF transaction.
 */
class InvoiceData
{
    /**
     * Create a new class instance.
     *
     * @param StoredInvoice $storedInvoice The signed and stored invoice.
     * @param InvoiceReceived $invoiceReceived The response received from DGII.
     * @param StoredAcknowledgment $storedAcknowledgment The stored acknowledgment for the transaction.
     */
    public function __construct(
        public StoredInvoice $storedInvoice,
        public InvoiceReceived $invoiceReceived,
        public StoredAcknowledgment $storedAcknowledgment,
    ) {
        //
    }
}
