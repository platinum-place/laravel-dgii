<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoices;

use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;

class ResolveInvoiceQrLinkAction
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    protected function getInvoiceQrLink(string $senderIdentification, string $sequenceNumber, string $totalAmount, string $securityCode, string $releaseDate, string $signatureDate, ?string $buyerIdentification = null, ?string $env = null): string
    {
        $env ??= config('dgii.environment');

        $parameters = [
            'RncEmisor' => $senderIdentification,
            'ENCF' => $sequenceNumber,
            'MontoTotal' => $totalAmount,
            'CodigoSeguridad' => $securityCode,
            'FechaEmision' => $releaseDate,
            'FechaFirma' => $signatureDate,
        ];

        if ($buyerIdentification) {
            $parameters['RncComprador'] = $buyerIdentification;
        }

        return sprintf(
            '%s/%s/%s?%s',
            config('dgii.domains.invoice'),
            $env,
            config('dgii.endpoints.invoice.qr'),
            http_build_query($parameters)
        );
    }

    protected function getConsumerInvoiceQrLink(string $senderIdentification, string $sequenceNumber, string $totalAmount, string $securityCode, ?string $env = null): string
    {
        $env ??= config('dgii.environment');

        $parameters = [
            'RncEmisor' => $senderIdentification,
            'ENCF' => $sequenceNumber,
            'MontoTotal' => $totalAmount,
            'CodigoSeguridad' => $securityCode,
        ];

        return sprintf(
            '%s/%s/%s?%s',
            config('dgii.domains.consumer_invoice'),
            $env,
            config('dgii.endpoints.consumer_invoice.qr'),
            http_build_query($parameters)
        );
    }

    public function handle(InvoiceXml $invoiceXml, ?string $env = null): string
    {
        $senderIdentification = $invoiceXml->getSenderIdentification();
        $sequenceNumber = $invoiceXml->getSequenceNumber();
        $totalAmount = $invoiceXml->getTotalAmount();
        $securityCode = $invoiceXml->getSecurityCode();
        $releaseDate = $invoiceXml->getReleaseDate();
        $signatureDate = $invoiceXml->getSignatureDate();
        $buyerIdentification = $invoiceXml->getBuyerIdentification();

        if ($invoiceXml->isConsumerInvoice()) {
            return $this->getConsumerInvoiceQrLink(
                $senderIdentification,
                $sequenceNumber,
                $totalAmount,
                $securityCode,
                $env
            );
        }

        return $this->getInvoiceQrLink(
            $senderIdentification,
            $sequenceNumber,
            $totalAmount,
            $securityCode,
            $releaseDate,
            $signatureDate,
            $buyerIdentification,
            $env
        );
    }
}
