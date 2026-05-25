<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use Illuminate\Support\Facades\View;
use PlatinumPlace\DgiiXmlSigner\SignManager;

class RenderInvoiceXmlAction
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function handle(string $certContent, string $certPassword, array $data): string
    {
        $xml = View::make('dgii::ecf.ecf_'.$data['IdDoc']['TipoeCF'], $data)->render();

        return (new SignManager)->sign($certContent, $certPassword, $xml);
    }
}
