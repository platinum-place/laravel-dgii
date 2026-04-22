<?php

namespace PlatinumPlace\LaravelDgii\Data\Invoice;

use PlatinumPlace\LaravelDgii\Data\Acknowledgment\AcknowledgmentXml;

/**
 * Data Transfer Object containing the complete lifecycle data of an e-CF transaction.
 */
class InvoiceData
{
    /**
     * Create a new class instance.
     *
     * @param  InvoiceXml  $invoiceXml  The signed main invoice XML object.
     * @param  string|null  $invoiceXmlPath  Relative path to the stored main XML.
     * @param  string|null  $qrLink  Public verification URL for the e-CF.
     * @param  InvoiceXml|null  $integralInvoiceXml  Optional integral XML for consumer summaries.
     * @param  string|null  $integralInvoiceXmlPath  Relative path to the stored integral XML.
     * @param  InvoiceReceived|null  $invoiceReceived  Submission response object from DGII.
     * @param  AcknowledgmentXml|null  $signedAcknowledgmentXml  Signed acknowledgment XML object.
     * @param  string|null  $acknowledgmentXmlPath  Relative path to the stored acknowledgment.
     */
    public function __construct(
        public InvoiceXml $invoiceXml,
        public ?string $invoiceXmlPath = null,

        public ?string $qrLink = null,

        public ?InvoiceXml $integralInvoiceXml = null,
        public ?string $integralInvoiceXmlPath = null,

        public ?InvoiceReceived $invoiceReceived = null,

        public ?AcknowledgmentXml $signedAcknowledgmentXml = null,
        public ?string $acknowledgmentXmlPath = null,
    ) {
        //
    }
}
