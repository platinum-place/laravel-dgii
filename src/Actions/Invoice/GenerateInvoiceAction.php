<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoice;

use Illuminate\Support\Facades\View;

/**
 * Action to generate raw Invoice XML (e-CF) content from templates.
 */
class GenerateInvoiceAction
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Generate the standard e-CF XML content based on the document type.
     *
     * @param  array  $data  Invoice data to populate templates.
     * @return string The generated XML content.
     */
    public function handle(array $data): string
    {
        return View::make('dgii::ecf.ecf_'.$data['IdDoc']['TipoeCF'], $data)->render();
    }
}
