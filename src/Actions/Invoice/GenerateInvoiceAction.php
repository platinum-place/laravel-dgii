<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoice;

use Illuminate\Support\Facades\View;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceGenerated;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceXml;

class GenerateInvoiceAction
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    private function signEcf(array $data): InvoiceXml
    {
        $xml = View::make('dgii::ecf.ecf_'.$data['IdDoc']['TipoeCF'], $data)->render();

        return new InvoiceXml($xml);
    }

    private function signRfce(InvoiceXml $ecf, array $data): InvoiceXml
    {
        $data['CodigoSeguridadeCF'] = $ecf->getSecurityCode();

        $xml = View::make('dgii::rfce.xml', $data)->render();

        return new InvoiceXml($xml);
    }

    public function handle(array $data): InvoiceGenerated
    {
        $invoiceXml = $this->signEcf($data);

        $integralInvoiceXml = $invoiceXml->isConsumeInvoice() ? $this->signRfce($invoiceXml, $data) : null;

        return new InvoiceGenerated($invoiceXml, $integralInvoiceXml);
    }
}
