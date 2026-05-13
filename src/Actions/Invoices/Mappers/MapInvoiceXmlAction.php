<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoices\Mappers;

use Illuminate\Support\Facades\View;

/**
 * Generates the raw XML string for an e-CF using Blade templates.
 */
class MapInvoiceXmlAction
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Render the XML template for a specific e-CF type.
     */
    public function handle(array $data): string
    {
        return View::make('dgii::ecf.ecf_'.$data['IdDoc']['TipoeCF'], $data)->render();
    }
}
