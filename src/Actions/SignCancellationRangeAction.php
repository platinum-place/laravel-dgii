<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use Illuminate\Support\Facades\View;
use PlatinumPlace\LaravelDgii\Data\InvoiceData;
use PlatinumPlace\LaravelDgii\Services\SignXmlService;

class SignCancellationRangeAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected SignXmlService $signXml, protected StorageInvoiceAction $storageInvoiceAction)
    {
        //
    }

    public function handle(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        $xml = View::make("dgii::anecf.xml", $data)->render();

        $signedXml = $this->signXml->handle($xml, $certPath, $certPassword);

        return $this->storageInvoiceAction->handle($signedXml, $env);
    }
}