<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoice;

use Barryvdh\DomPDF\Facade\Pdf;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceXml;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GenerateInvoicePdfAction
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Generar el contenido binario de un PDF fiscal para un e-CF.
     * Utiliza internamente barryvdh/laravel-dompdf para renderizar la vista 'dgii::invoice-template'.
     *
     * @param  string  $xmlContent  Contenido XML completo del e-CF firmado.
     * @param  string  $qrLink  URL completa del timbre fiscal (ConsultaTimbre).
     * @param  string|null  $logo  Contenido binario del logo de la empresa.
     * @return string Contenido binario del PDF.
     */
    public function handle(string $xmlContent, string $qrLink, ?string $logo = null): string
    {
        $invoice = new InvoiceXml($xmlContent);

        return Pdf::loadView('dgii::invoice-template', [
            'qr' => base64_encode(
                QrCode::format('png')
                    ->size(120)
                    ->margin(1)
                    ->generate($qrLink)
            ),
            'logoBase64' => $logo ? base64_encode($logo) : null,
            'invoice' => $invoice,
        ])
            ->setPaper('A4')
            ->output();
    }
}
