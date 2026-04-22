<?php

namespace PlatinumPlace\LaravelDgii\Data\Invoice;

/**
 * Data Transfer Object containing the complete lifecycle data of an e-CF transaction.
 */
readonly class StoredInvoice
{
    public function __construct(
        public string $invoiceXmlPath,
        public ?string $integralInvoiceXmlPath = null,
    ) {
        //
    }
}
