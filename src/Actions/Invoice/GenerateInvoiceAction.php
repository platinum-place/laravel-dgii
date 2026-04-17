<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoice;

use Illuminate\Support\Facades\View;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceGenerated;
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
     * Generate the standard e-CF XML content.
     */
    private function signEcf(array $data): InvoiceXml
    {
        $xml = View::make('dgii::ecf.ecf_'.$data['IdDoc']['TipoeCF'], $data)->render();

        return new InvoiceXml($xml);
    }

    /**
     * Generate the Consumer Summary (RFCE) XML content if required.
     */
    private function signRfce(InvoiceXml $ecf, array $data): InvoiceXml
    {
        $data['CodigoSeguridadeCF'] = $ecf->getSecurityCode();

        $xml = View::make('dgii::rfce.xml', $data)->render();

        return new InvoiceXml($xml);
    }

    /**
     * Handle the generation of one or more XML objects for an invoice.
     *
     * @param  array  $data  Invoice data.
     * @return InvoiceGenerated Object containing the main and optionally integral XMLs.
     */
    public function handle(array $data): InvoiceGenerated
    {
        $invoiceXml = $this->signEcf($data);

        $integralInvoiceXml = $invoiceXml->isConsumeInvoice() ? $this->signRfce($invoiceXml, $data) : null;

        return new InvoiceGenerated($invoiceXml, $integralInvoiceXml);
    }
}
