<?php

namespace PlatinumPlace\LaravelDgii\Services;

use Throwable;

class DgiiXmlRender
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Render an Acknowledgment of Receipt (ARECF) XML string.
     *
     * @param  string  $senderIdentification  RNC of the sender
     * @param  string  $buyerIdentification   RNC of the buyer
     * @param  string  $sequenceNumber        e-CF sequence number (eNCF)
     * @param  string  $status                 Status code of the receipt
     * @param  string|null  $notReceivedCode   Optional code for not received reasons
     * @return string
     *
     * @throws Throwable
     */
    public function renderAcknowledgment(string $senderIdentification, string $buyerIdentification, string $sequenceNumber, string $status, ?string $notReceivedCode = null): string
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

        return view('dgii::arecf.xml', $data)->render();
    }

    /**
     * Render a Cancellation Range (ANECF) XML string.
     *
     * @param  array  $data
     * @return string
     *
     * @throws Throwable
     */
    public function renderCancellationRange(array $data): string
    {
        return view('dgii::anecf.xml', $data)->render();
    }

    /**
     * Render an e-CF Invoice XML string.
     *
     * @param  array  $data
     * @return string
     *
     * @throws Throwable
     */
    public function renderInvoice(array $data): string
    {
        return view('dgii::ecf.ecf_' . $data['IdDoc']['TipoeCF'], $data)->render();
    }

    /**
     * Render a Consumer e-CF Invoice (RFCE) XML string.
     *
     * @param  string  $securityCode  Security code from the signed invoice signature
     * @param  array  $data
     * @return string
     *
     * @throws Throwable
     */
    public function renderConsumerInvoice(string $securityCode, array $data): string
    {
        $data['CodigoSeguridadeCF'] = $securityCode;
        return view('dgii::rfce.xml', $data)->render();
    }

    /**
     * Render a seed XML string.
     *
     * @param  string  $value
     * @param  string  $date
     * @return string
     *
     * @throws Throwable
     */
    public function renderSeed(string $value, string $date): string
    {
        return view('dgii::seeds.xml', ['valor' => $value, 'fecha' => $date])->render();
    }
}

