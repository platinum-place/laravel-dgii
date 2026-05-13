<?php

namespace PlatinumPlace\LaravelDgii\Actions\Acknowledgments\Mappers;

use Illuminate\Support\Facades\View;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceResponse;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\Enums\AcknowledgmentCodeEnum;
use PlatinumPlace\LaravelDgii\Enums\AcknowledgmentStatusEnum;

/**
 * Generates the raw XML string for an Acknowledgment of Receipt (ARECF).
 */
class MapAcknowledgmentXmlAction
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Map invoice and response data to the ARECF XML template.
     */
    public function handle(InvoiceXml $invoiceXml, InvoiceResponse $invoiceReceived): string
    {
        $arecfCodeId = null;

        // TODO: validate more error codes
        if ($invoiceReceived->acknowledgmentStatusEnum === AcknowledgmentStatusEnum::NOT_RECEIVED) {
            $arecfCodeId = AcknowledgmentCodeEnum::SPECIFICATION_ERROR->value;
        }

        $data = [
            'RNCEmisor' => $invoiceXml->getSenderIdentification(),
            'RNCComprador' => $invoiceXml->getBuyerIdentification(),
            'eNCF' => $invoiceXml->getSequenceNumber(),
            'Estado' => $invoiceReceived->acknowledgmentStatusEnum->value,
        ];

        if ($arecfCodeId) {
            $data['CodigoMotivoNoRecibido'] = $arecfCodeId;
        }

        return View::make('dgii::arecf.xml', $data)->render();
    }
}
