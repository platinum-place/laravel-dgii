<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use Illuminate\Support\Facades\View;
use PlatinumPlace\LaravelDgii\Data\InvoiceData;
use PlatinumPlace\LaravelDgii\Helpers\StorageHelper;
use PlatinumPlace\LaravelDgii\Services\SignXmlService;
use PlatinumPlace\LaravelDgii\ValueObjects\InvoiceXml;

class SignCancellationRangeAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected SignXmlService $signXml, protected StorageHelper $storageHelper)
    {
        //
    }

    public function handle(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): string
    {
        $xml = View::make("dgii::anecf.xml", $data)->render();

        $signedXml = $this->signXml->handle($xml, $certPath, $certPassword);

        return $this->storageHelper->putXml($signedXml);
    }
}