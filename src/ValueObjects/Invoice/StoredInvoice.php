<?php

namespace PlatinumPlace\LaravelDgii\ValueObjects\Invoice;

/**
 * Data object for a stored Invoice in the file system.
 */
readonly class StoredInvoice
{
    /**
     * Create a new class instance.
     *
     * @param  SignedInvoice  $signedInvoice  The signed invoice object.
     * @param  string  $invoiceXmlPath  Path where the main XML is stored.
     * @param  string|null  $integralInvoiceXmlPath  Path where the integral XML is stored (if any).
     */
    public function __construct(
        public SignedInvoice $signedInvoice,
        public string $invoiceXmlPath,
        public ?string $integralInvoiceXmlPath = null,
    ) {
        //
    }
}
