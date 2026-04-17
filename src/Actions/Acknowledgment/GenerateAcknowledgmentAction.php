<?php

namespace PlatinumPlace\LaravelDgii\Actions\Acknowledgment;

use Illuminate\Support\Facades\View;
use PlatinumPlace\LaravelDgii\Enums\ArecfCodeEnum;
use PlatinumPlace\LaravelDgii\Enums\ArecfStatusEnum;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceReceived;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceXml;

class GenerateAcknowledgmentAction
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function handle(InvoiceXml $invoiceXml, InvoiceReceived $invoiceReceived)
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
