<?php

namespace PlatinumPlace\LaravelDgii\Data;

use PlatinumPlace\LaravelDgii\ValueObjects\InvoiceXml;

class InvoiceData
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public InvoiceXml   $xml,
        public string       $xmlPath,
        public string       $qrLink,
        public ?InvoiceData $integralInvoice = null,
    )
    {
        //
    }
}