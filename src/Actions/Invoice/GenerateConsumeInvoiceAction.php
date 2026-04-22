<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoice;

use Illuminate\Support\Facades\View;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;

/**
 * Generates the raw XML content for a Consumer Electronic Invoice (RFCE) from templates.
 */
class GenerateConsumeInvoiceAction
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Generate the Consumer Summary (RFCE) XML content for consumer invoices.
     *
     * @param  InvoiceXml  $ecf  The previously generated e-CF XML.
     * @param  array  $data  Invoice data.
     * @return string The generated RFCE XML content.
     */
    public function handle(InvoiceXml $ecf, array $data): string
    {
        $data['CodigoSeguridadeCF'] = $ecf->getSecurityCode();

        return View::make('dgii::rfce.xml', $data)->render();
    }
}
