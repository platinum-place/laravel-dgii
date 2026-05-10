<?php

namespace PlatinumPlace\LaravelDgii\Services;

use Illuminate\Support\Facades\View;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;

/**
 * Service to generate raw Invoice XML (e-CF) and Consumer Summary (RFCE) content.
 *
 * This class maps structured invoice data to the corresponding Blade templates
 * according to the document type defined by the DGII.
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
     * Flow: Identify TipoeCF -> Load specific Blade template -> Render with invoice data -> Return XML.
     *
     * @param  array  $data  Invoice data structure (Header, Items, Totals).
     * @return string The generated XML content.
     */
    public function makeInvoice(array $data): string
    {
        return View::make('dgii::ecf.ecf_'.$data['IdDoc']['TipoeCF'], $data)->render();
    }

    /**
     * Generate the Consumer Summary (RFCE) XML content for consumer invoices.
     *
     * Flow: Extract security code from e-CF -> Inject into data -> Render RFCE Blade template -> Return XML.
     *
     * @param  InvoiceXml  $ecf  The previously generated and signed e-CF XML data object.
     * @param  array  $data  General invoice data.
     * @return string The generated RFCE XML content.
     */
    public function makeConsumeInvoice(InvoiceXml $ecf, array $data): string
    {
        $data['CodigoSeguridadeCF'] = $ecf->getSecurityCode();

        return View::make('dgii::rfce.xml', $data)->render();
    }
}
