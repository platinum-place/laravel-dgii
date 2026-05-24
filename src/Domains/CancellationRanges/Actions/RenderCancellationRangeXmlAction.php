<?php

namespace PlatinumPlace\LaravelDgii\Domains\CancellationRanges\Actions;

use Illuminate\Support\Facades\View;
use PlatinumPlace\DgiiXmlSigner\SignManager;

class RenderCancellationRangeXmlAction
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
        $xml = View::make('dgii::anecf.xml', $data)->render();

        return (new SignManager)->sign($certContent, $certPassword, $xml);
    }
}
