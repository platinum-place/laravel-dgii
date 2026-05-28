<?php

namespace PlatinumPlace\LaravelDgii\Services;

use PlatinumPlace\DgiiXmlSigner\SignManager;
use Throwable;

class DgiiXmlRender
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected SignManager $signManager)
    {
        //
    }

    /**
     * @throws Throwable
     */
    public function renderAcknowledgment(string $certContent, string $certPassword, string $senderIdentification, string $buyerIdentification, string $sequenceNumber, string $status, ?string $notReceivedCode = null): string
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

        $xml = view('dgii::arecf.xml', $data)->render();

        return $this->signManager->sign($certContent, $certPassword, $xml);
    }

    /**
     * @throws Throwable
     */
    public function renderCancellationRange(string $certContent, string $certPassword, array $data): string
    {
        $xml = view('dgii::anecf.xml', $data)->render();

        return $this->signManager->sign($certContent, $certPassword, $xml);
    }

    /**
     * @throws Throwable
     */
    public function renderInvoice(string $certContent, string $certPassword, array $data): string
    {
        $xml = view('dgii::ecf.ecf_'.$data['IdDoc']['TipoeCF'], $data)->render();

        return $this->signManager->sign($certContent, $certPassword, $xml);
    }

    /**
     * @throws Throwable
     */
    public function renderConsumerInvoice(string $certContent, string $certPassword, array $data): array
    {
        $integralXml = $this->renderInvoice($certContent, $certPassword, $data);

        $loadedXml = simplexml_load_string($integralXml);
        $securityCode = substr((string) $loadedXml->Signature->SignatureValue, 0, 6);

        $data['CodigoSeguridadeCF'] = $securityCode;
        $xml = view('dgii::rfce.xml', $data)->render();

        return [
            'xml' => $this->signManager->sign($certContent, $certPassword, $xml),
            'integral' => $integralXml,
        ];
    }

    /**
     * @throws Throwable
     */
    public function renderSeed(string $value, string $date): string
    {
        return view('dgii::seeds.xml', ['valor' => $value, 'fecha' => $date])->render();
    }
}
