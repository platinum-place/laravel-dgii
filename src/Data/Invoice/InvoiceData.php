<?php

namespace PlatinumPlace\LaravelDgii\Data\Invoice;

use PlatinumPlace\LaravelDgii\Data\Acknowledgment\AcknowledgmentXml;

/**
 * Data Transfer Object containing the complete lifecycle data of an e-CF transaction.
 */
readonly class InvoiceData
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public SignedInvoice $signedInvoice,

        public ?string $qrLink = null,

        public ?StoredInvoice $storedInvoice = null,

        public ?InvoiceReceived $invoiceReceived = null,

        public ?AcknowledgmentXml $signedAcknowledgmentXml = null,
        public ?string $acknowledgmentXmlPath = null,
    ) {
        //
    }
}
