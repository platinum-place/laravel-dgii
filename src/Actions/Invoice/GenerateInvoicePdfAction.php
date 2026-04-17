<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoice;

use Barryvdh\DomPDF\Facade\Pdf;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceXml;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

/**
 * Action to generate a PDF representation of an e-CF.
 */
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
     * Generate the binary PDF content for a fiscal e-CF.
     *
     * Uses barryvdh/laravel-dompdf to render the 'dgii::invoice-template' view.
     *
     * @param  string  $xmlContent  Signed e-CF XML content.
     * @param  string  $qrLink  Full URL for the fiscal stamp (ConsultaTimbre).
     * @param  string|null  $logo  Optional company logo binary content.
     * @return string Binary PDF content.
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
