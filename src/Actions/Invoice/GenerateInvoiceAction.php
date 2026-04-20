<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoice;

use Illuminate\Support\Facades\View;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceXml;

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
     * Generate the standard e-CF XML content based on document type.
     *
     * @param  array  $data  Invoice data to populate templates.
     * @return InvoiceXml The generated XML value object.
     */
    private function signEcf(array $data): InvoiceXml
    {
        $xml = View::make('dgii::ecf.ecf_'.$data['IdDoc']['TipoeCF'], $data)->render();

        return new InvoiceXml($xml);
    }

    /**
     * Generate the Consumer Summary (RFCE) XML content for consumer invoices.
     *
     * @param  InvoiceXml  $ecf  The previously generated e-CF XML.
     * @param  array  $data  Invoice data.
     * @return InvoiceXml The generated RFCE XML value object.
     */
    private function signRfce(InvoiceXml $ecf, array $data): InvoiceXml
    {
        $data['CodigoSeguridadeCF'] = $ecf->getSecurityCode();

        $xml = View::make('dgii::rfce.xml', $data)->render();

        return new InvoiceXml($xml);
    }

    /**
     * Handle the generation of XML objects for an invoice.
     *
     * It may return two XMLs if the invoice is a consumer invoice (RFCE + e-CF).
     *
     * @param  array  $data  Full invoice data.
     * @return array An array containing [InvoiceXml, ?InvoiceXml] (main and optionally integral XML).
     */
    public function handle(array $data): array
    {
        $invoiceXml = $this->signEcf($data);

        $integralInvoiceXml = null;

        if ($invoiceXml->isConsumeInvoice()) {
            $integralInvoiceXml = $invoiceXml;

            $invoiceXml = $this->signRfce($invoiceXml, $data);
        }

        return [$invoiceXml, $integralInvoiceXml];
    }
}
