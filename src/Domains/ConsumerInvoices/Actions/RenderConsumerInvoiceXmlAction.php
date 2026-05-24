<?php

namespace PlatinumPlace\LaravelDgii\Domains\ConsumerInvoices\Actions;

use Illuminate\Support\Facades\View;
use PlatinumPlace\DgiiXmlSigner\SignManager;
use PlatinumPlace\LaravelDgii\Domains\Invoices\Actions\RenderInvoiceXmlAction;

class RenderConsumerInvoiceXmlAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected RenderInvoiceXmlAction $renderIntegral,
    ) {
        //
    }

    public function handle(string $certContent, string $certPassword, array $data): array
    {
        $integralXml = $this->renderIntegral->handle($certContent, $certPassword, $data);

        $loadedXml = simplexml_load_string($integralXml);
        $securityCode = substr((string) $loadedXml->Signature->SignatureValue, 0, 6);

        $data['CodigoSeguridadeCF'] = $securityCode;
        $xml = View::make('dgii::rfce.xml', $data)->render();

        return [
            'xml' => (new SignManager)->sign($certContent, $certPassword, $xml),
            'integral' => $integralXml,
        ];
    }
}
