<?php

namespace PlatinumPlace\LaravelDgii\ValueObjects\Invoice;

/**
 * Data object for a generated Invoice XML (before signing).
 */
readonly class InvoiceGenerated
{
    /**
     * Create a new class instance.
     *
     * @param InvoiceXml $invoiceXml The generated invoice XML object.
     * @param InvoiceXml|null $integralInvoiceXml Optional integral invoice XML for certain types.
     */
    public function __construct(
        public InvoiceXml $invoiceXml,
        public ?InvoiceXml $integralInvoiceXml = null,
    ) {
        //
    }
}
