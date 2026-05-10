<?php

namespace PlatinumPlace\LaravelDgii\Services;

use Illuminate\Support\Facades\View;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceReceived;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\Enums\ArecfCodeEnum;
use PlatinumPlace\LaravelDgii\Enums\ArecfStatusEnum;

/**
 * Service to generate Acknowledgment (ARECF) XML documents.
 *
 * This service creates the XML required to acknowledge the receipt of an e-CF,
 * including the status (received or rejected) and any relevant error codes.
 */
class AcknowledgmentXmlParse
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Generate the ARECF XML content based on an invoice and its reception status.
     *
     * Flow: Extract data from InvoiceXml and InvoiceReceived -> Determine error codes -> Render Blade template -> Return XML.
     *
     * @param  InvoiceXml  $invoiceXml  The original invoice XML data object.
     * @param  InvoiceReceived  $invoiceReceived  The response data from the submission.
     * @return string The rendered ARECF XML content.
     */
    public function make(InvoiceXml $invoiceXml, InvoiceReceived $invoiceReceived): string
    {
        $arecfCodeId = null;

        // TODO: validate more error codes
        if ($invoiceReceived->arecfStatusEnum === ArecfStatusEnum::NOT_RECEIVED) {
            $arecfCodeId = ArecfCodeEnum::SPECIFICATION_ERROR->value;
        }

        $data = [
            'RNCEmisor' => $invoiceXml->getSenderIdentification(),
            'RNCComprador' => $invoiceXml->getBuyerIdentification(),
            'eNCF' => $invoiceXml->getSequenceNumber(),
            'Estado' => $invoiceReceived->arecfStatusEnum->value,
        ];

        if ($arecfCodeId) {
            $data['CodigoMotivoNoRecibido'] = $arecfCodeId;
        }

        return View::make('dgii::arecf.xml', $data)->render();
    }
}
