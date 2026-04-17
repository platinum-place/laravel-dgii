<?php

namespace PlatinumPlace\LaravelDgii\Actions\Acknowledgment;

use Illuminate\Support\Facades\View;
use PlatinumPlace\LaravelDgii\Enums\ArecfCodeEnum;
use PlatinumPlace\LaravelDgii\Enums\ArecfStatusEnum;
use PlatinumPlace\LaravelDgii\Support\StorageService;
use PlatinumPlace\LaravelDgii\Support\XmlSigner;
use PlatinumPlace\LaravelDgii\ValueObjects\Acknowledgment\SignedAcknowledgment;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceReceived;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceXml;

class SignAcknowledgmentAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected XmlSigner $xmlSigner,
        protected StorageService $storageService
    ) {
        //
    }

    private function mapXml(InvoiceXml $invoiceXml, InvoiceReceived $invoiceReceived): array
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

        return $data;
    }

    /**
     * Generar y firmar el XML de Acuse de Recibo (ARECF) para un comprobante recibido.
     *
     * @param  string|null  $certPath  Ruta al certificado.
     * @param  string|null  $certPassword  Contraseña del certificado.
     * @return SignedAcknowledgment Ruta relativa del XML firmado y almacenado.
     */
    public function handle(InvoiceXml $invoiceXml, InvoiceReceived $invoiceReceived, ?string $certPath = null, ?string $certPassword = null): SignedAcknowledgment
    {
        $data = $this->mapXml($invoiceXml, $invoiceReceived);

        $xml = View::make('dgii::arecf.xml', $data)->render();

        $signedXml = $this->xmlSigner->sign($xml, $certPath, $certPassword);

        $xmlPath = $this->storageService->putXml($signedXml);

        return new SignedAcknowledgment($signedXml, $xmlPath);
    }
}
