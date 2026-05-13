<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoices\Mappers;

use Illuminate\Support\Facades\View;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;

/**
 * Generates the raw XML string for a Consumer Invoice Summary (RFCE).
 */
class MapConsumerInvoiceXmlAction
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Render the RFCE XML template using Blade.
     */
    public function handle(InvoiceXml $invoice, array $data): string
    {
        $data['CodigoSeguridadeCF'] = $invoice->getSecurityCode();

        return View::make('dgii::rfce.xml', $data)->render();
    }
}
