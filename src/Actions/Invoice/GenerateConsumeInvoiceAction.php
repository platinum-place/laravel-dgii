<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoice;

use Illuminate\Support\Facades\View;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceXml;

/**
 * Action to generate raw Invoice XML (e-CF) content from templates.
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
