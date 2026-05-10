<?php

namespace PlatinumPlace\LaravelDgii\Services;

use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;

class DgiiQrResolver
{
    /**
     * Generate the link for the QR stamp verification.
     *
     * @param  string  $senderIdentification  Sender identification number.
     * @param  string  $sequenceNumber  Sequence number of the invoice.
     * @param  string  $totalAmount  Total amount of the invoice.
     * @param  string  $securityCode  Security code of the invoice.
     * @param  string  $releaseDate  Release date of the invoice.
     * @param  string  $signatureDate  Signature date of the invoice.
     * @param  string|null  $buyerIdentification  Optional buyer identification number.
     * @param  string|null  $env  The environment (testecf, certecf, ecf).
     * @return string Full URL for the QR code.
     */
    public function getEcfQrLink(string $senderIdentification, string $sequenceNumber, string $totalAmount, string $securityCode, string $releaseDate, string $signatureDate, ?string $buyerIdentification = null, ?string $env = null): string
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
            config('dgii.domains.ecf'),
            $env,
            config('dgii.endpoints.invoice.qr'),
            http_build_query($parameters)
        );
    }

    /**
     * Generate the link for the QR stamp verification for consumption invoices.
     *
     * @param  string  $senderIdentification  Sender identification number.
     * @param  string  $sequenceNumber  Sequence number of the invoice.
     * @param  string  $totalAmount  Total amount of the invoice.
     * @param  string  $securityCode  Security code of the invoice.
     * @param  string|null  $env  The environment (testecf, certecf, ecf).
     * @return string Full URL for the QR code.
     */
    public function getRfceQrLink(string $senderIdentification, string $sequenceNumber, string $totalAmount, string $securityCode, ?string $env = null): string
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
            config('dgii.domains.fc'),
            $env,
            config('dgii.endpoints.fc.timbre'),
            http_build_query($parameters)
        );
    }

    public function getInvoiceQrLink(InvoiceXml $invoiceXml, ?string $env = null): string
    {
        $senderIdentification = $invoiceXml->getSenderIdentification();
        $sequenceNumber = $invoiceXml->getSequenceNumber();
        $totalAmount = $invoiceXml->getTotalAmount();
        $securityCode = $invoiceXml->getSecurityCode();
        $releaseDate = $invoiceXml->getReleaseDate();
        $signatureDate = $invoiceXml->getSignatureDate();
        $buyerIdentification = $invoiceXml->getBuyerIdentification();

        if ($invoiceXml->isConsumeInvoice()) {
            return $this->getRfceQrLink(
                $senderIdentification,
                $sequenceNumber,
                $totalAmount,
                $securityCode,
                $env
            );
        }

        return $this->getEcfQrLink(
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
