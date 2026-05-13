<?php

namespace PlatinumPlace\LaravelDgii\Actions\Acknowledgments\Mappers;

use Illuminate\Support\Facades\View;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceResponse;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\Enums\ArecfCodeEnum;
use PlatinumPlace\LaravelDgii\Enums\ArecfStatusEnum;

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
