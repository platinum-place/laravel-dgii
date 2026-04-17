<?php

namespace PlatinumPlace\LaravelDgii\ValueObjects\Invoice;

readonly class InvoiceGenerated
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public InvoiceXml $invoiceXml,
        public ?InvoiceXml $integralInvoiceXml = null,
    ) {
        //
    }
}
