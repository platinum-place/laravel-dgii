<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoices\Mappers;

use Illuminate\Support\Facades\View;

class MapInvoiceXmlAction
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function handle(array $data): string
    {
        return View::make('dgii::ecf.ecf_'.$data['IdDoc']['TipoeCF'], $data)->render();
    }
}
