<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoices\Mappers;

use Illuminate\Support\Facades\View;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;

/**
 * Generates the raw XML string for a Consumption Invoice Summary (RFCE).
 */
class MapConsumeInvoiceXmlAction
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
    public function handle(InvoiceXml $ecf, array $data): string
    {
        $data['CodigoSeguridadeCF'] = $ecf->getSecurityCode();

        return View::make('dgii::rfce.xml', $data)->render();
    }
}
