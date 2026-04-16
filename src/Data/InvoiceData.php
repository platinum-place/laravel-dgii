<?php

namespace PlatinumPlace\LaravelDgii\Data;

use PlatinumPlace\LaravelDgii\ValueObjects\InvoiceXml;

class InvoiceData
{
    /**
     * Create a new class instance.
     *
     * @param  InvoiceXml  $xml  Instancia del ValueObject con los datos parseados.
     * @param  string  $xmlPath  Ruta relativa del archivo guardado en el disco.
     * @param  string  $qrLink  URL completa del timbre fiscal para el QR.
     * @param  InvoiceData|null  $integralInvoice  Referencia al e-CF base (solo para RFCE).
     */
    public function __construct(
        public InvoiceXml $xml,
        public string $xmlPath,
        public string $qrLink,
        public ?InvoiceData $integralInvoice = null,
    ) {
        //
    }
}
