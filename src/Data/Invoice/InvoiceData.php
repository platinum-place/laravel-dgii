<?php

namespace PlatinumPlace\LaravelDgii\Data\Invoice;

use PlatinumPlace\LaravelDgii\Data\Acknowledgment\AcknowledgmentData;

/**
 * Data Transfer Object containing the complete lifecycle data of an e-CF transaction.
 *
 * This class serves as a container for all relevant data produced during the invoice processing,
 * from the initial XML generation to the final DGII response and buyer acknowledgment.
 */
readonly class InvoiceData
{
    /**
     * Create a new InvoiceData instance.
     *
     * @param  InvoiceXml  $xml  The parsed invoice XML object.
     * @param  string|null  $path  The absolute path where the XML file is stored.
     * @param  string|null  $qrLink  The generated QR code link for the invoice.
     * @param  InvoiceXml|null  $integralXml  The parsed integral invoice XML object (if applicable).
     * @param  string|null  $integralPath  The path to the integral XML file.
     * @param  InvoiceReceived|null  $response  The response received from DGII after submission.
     * @param  AcknowledgmentData|null  $acknowledgment  The acknowledgment data received from the buyer.
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
