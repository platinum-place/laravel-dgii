<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use Illuminate\Support\Facades\View;
use PlatinumPlace\LaravelDgii\Data\InvoiceData;
use PlatinumPlace\LaravelDgii\Helpers\StorageHelper;
use PlatinumPlace\LaravelDgii\Services\SignXmlService;
use PlatinumPlace\LaravelDgii\ValueObjects\InvoiceXml;

class SignInvoiceAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected SignXmlService $signXml, protected StorageInvoiceAction $storageInvoiceAction)
    {
        //
    }

    private function signEcf(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        $xml = View::make('dgii::ecf.ecf_' . $data['IdDoc']['TipoeCF'], $data)->render();

        $signedXml = $this->signXml->handle($xml, $certPath, $certPassword);

        return $this->storageInvoiceAction->handle($signedXml, $env);
    }

    private function signRfce(InvoiceData $ecf, array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        $data['CodigoSeguridadeCF'] = $ecf->xml->getSecurityCode();

        $xml = View::make("dgii::rfce.xml", $data)->render();

        $signedXml = $this->signXml->handle($xml, $certPath, $certPassword);

        return $this->storageInvoiceAction->handle($signedXml, $env, $ecf);
    }

    public function handle(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        $ecf = $this->signEcf($data, $env, $certPath, $certPassword);

        if ($ecf->xml->isConsumeInvoice()) {
            return $this->signRfce($ecf, $data, $env, $certPath, $certPassword);
        }

        return $ecf;
    }
}