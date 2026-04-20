<?php

namespace PlatinumPlace\LaravelDgii\Actions\Acknowledgment;

use Illuminate\Support\Facades\View;
use PlatinumPlace\LaravelDgii\Enums\ArecfCodeEnum;
use PlatinumPlace\LaravelDgii\Enums\ArecfStatusEnum;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceReceived;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceXml;

/**
 * Action to generate the Acknowledgment (Acuse de Recibo) XML content.
 */
class GenerateAcknowledgmentAction
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Generate the Acknowledgment XML content based on the received invoice and DGII response.
     *
     * @param  InvoiceXml  $invoiceXml  The original invoice XML object.
     * @param  InvoiceReceived  $invoiceReceived  The response object received from DGII.
     * @return string The generated XML content as a string.
     */
    public function handle(InvoiceXml $invoiceXml, InvoiceReceived $invoiceReceived): string
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
