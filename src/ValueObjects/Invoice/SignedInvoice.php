<?php

namespace PlatinumPlace\LaravelDgii\ValueObjects\Invoice;

/**
 * Data object for a signed Invoice (e-CF).
 */
class SignedInvoice
{
    /**
     * Create a new class instance.
     *
     * @param InvoiceXml $invoiceXml The signed invoice XML object.
     * @param string|null $qrLink Generated QR link for verification.
     * @param InvoiceXml|null $integralInvoiceXml Optional integral invoice XML for certain types.
     */
    public function __construct(
        public InvoiceXml $invoiceXml,
        public ?string $qrLink = null,
        public ?InvoiceXml $integralInvoiceXml = null,
    ) {
        //
    }
}
