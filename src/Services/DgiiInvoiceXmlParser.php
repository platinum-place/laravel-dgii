<?php

namespace PlatinumPlace\LaravelDgii\Services;

use Illuminate\Support\Facades\View;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;

/**
 * Action to generate raw Invoice XML (e-CF) content from templates.
 */
class DgiiInvoiceXmlParser
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
    public function makeInvoice(array $data): string
    {
        return View::make('dgii::ecf.ecf_'.$data['IdDoc']['TipoeCF'], $data)->render();
    }

    /**
     * Generate the Consumer Summary (RFCE) XML content for consumer invoices.
     *
     * @param  InvoiceXml  $ecf  The previously generated e-CF XML.
     * @param  array  $data  Invoice data.
     * @return string The generated RFCE XML content.
     */
    public function makeConsumeInvoice(InvoiceXml $ecf, array $data): string
    {
        $data['CodigoSeguridadeCF'] = $ecf->getSecurityCode();

        return View::make('dgii::rfce.xml', $data)->render();
    }
}
