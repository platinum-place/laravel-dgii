<?php

namespace PlatinumPlace\LaravelDgii\Data\Invoice;

use PlatinumPlace\LaravelDgii\Data\Acknowledgment\AcknowledgmentData;

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
        public ?InvoiceResponse $response = null,
        public ?AcknowledgmentData $acknowledgment = null,
    ) {
        //
    }
}
