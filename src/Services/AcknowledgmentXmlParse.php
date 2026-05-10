<?php

namespace PlatinumPlace\LaravelDgii\Services;

use Illuminate\Support\Facades\View;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceReceived;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\Enums\ArecfCodeEnum;
use PlatinumPlace\LaravelDgii\Enums\ArecfStatusEnum;

class AcknowledgmentXmlParse
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

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
