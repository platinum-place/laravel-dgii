<?php

namespace PlatinumPlace\LaravelDgii\ValueObjects\Invoice;

class SignedInvoice
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public InvoiceXml $invoiceXml,
        public string $qrLink,
        public ?InvoiceXml $integralInvoiceXml = null,
    ) {
        //
    }
}
