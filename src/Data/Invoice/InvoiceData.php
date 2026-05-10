<?php

namespace PlatinumPlace\LaravelDgii\Data\Invoice;

use PlatinumPlace\LaravelDgii\Data\Acknowledgment\AcknowledgmentData;

/**
 * Data Transfer Object containing the complete lifecycle data of an e-CF transaction.
 */
readonly class InvoiceData
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public InvoiceXml $xml,
        public ?string $path = null,
        public ?string $qrLink = null,
        public ?InvoiceXml $integralXml = null,
        public ?string $integralPath = null,
        public ?InvoiceReceived $response = null,
        public ?AcknowledgmentData $acknowledgment = null,
    ) {
        //
    }
}
