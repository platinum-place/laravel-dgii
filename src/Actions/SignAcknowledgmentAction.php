<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use Illuminate\Support\Facades\View;
use PlatinumPlace\LaravelDgii\Helpers\StorageHelper;
use PlatinumPlace\LaravelDgii\Services\SignXmlService;

class SignAcknowledgmentAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected SignXmlService $signXml, protected StorageHelper $storageHelper)
    {
        //
    }

    public function handle(array $data, ?string $certPath = null, ?string $certPassword = null): string
    {
        $xml = View::make("dgii::arecf.xml", $data)->render();

        $signedXml = $this->signXml->handle($xml, $certPath, $certPassword);

        return $this->storageHelper->putXml($signedXml);
    }
}