<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use Illuminate\Support\Facades\View;
use PlatinumPlace\DgiiXmlSigner\SignManager;

class RenderAcknowledgmentXmlAction
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function handle(string $certContent, string $certPassword, string $senderIdentification, string $buyerIdentification, string $sequenceNumber, string $status, ?string $notReceivedCode = null): string
    {
        $data = [
            'RNCEmisor' => $senderIdentification,
            'RNCComprador' => $buyerIdentification,
            'eNCF' => $sequenceNumber,
            'Estado' => $status,
        ];

        if ($notReceivedCode) {
            $data['CodigoMotivoNoRecibido'] = $notReceivedCode;
        }

        $xml = View::make('dgii::arecf.xml', $data)->render();

        return (new SignManager)->sign($certContent, $certPassword, $xml);
    }
}
