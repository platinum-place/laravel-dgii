<?php

namespace PlatinumPlace\LaravelDgii\ValueObjects\Invoice;

readonly class StoredInvoice
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public SignedInvoice $signedInvoice,
        public string $invoiceXmlPath,
        public ?string $integralInvoiceXmlPath = null,
    ) {
        //
    }
}
