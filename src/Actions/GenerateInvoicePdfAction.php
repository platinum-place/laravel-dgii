<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use Barryvdh\DomPDF\Facade\Pdf;
use PlatinumPlace\LaravelDgii\ValueObjects\InvoiceXml;
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
