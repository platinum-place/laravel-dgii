<?php

namespace PlatinumPlace\LaravelDgii\Data\Invoice;

/**
 * Data Transfer Object containing the complete lifecycle data of an e-CF transaction.
 */
readonly class SignedInvoice
{
    public function __construct(
        public InvoiceXml $invoiceXml,
        public ?InvoiceXml $integralInvoiceXml = null,
    ) {
        //
    }
}
