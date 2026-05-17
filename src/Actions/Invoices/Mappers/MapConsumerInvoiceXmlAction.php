<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoices\Mappers;

use Illuminate\Support\Facades\View;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;

class MapConsumerInvoiceXmlAction
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function handle(InvoiceXml $invoice, array $data): string
    {
        $data['CodigoSeguridadeCF'] = $invoice->getSecurityCode();

        return View::make('dgii::rfce.xml', $data)->render();
    }
}
