<?php

namespace PlatinumPlace\LaravelDgii\Services;

use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;

/**
 * Service to resolve verification URLs for QR code generation.
 *
 * This class constructs the absolute URLs required for the QR stamps on
 * printed e-CF representations, enabling verification against DGII services.
 */
class DgiiQrResolver
{
    /**
     * Generate the link for the QR stamp verification.
     *
     * Flow: Take raw invoice attributes -> Resolve domain and endpoint from config -> Build query string -> Return full URL.
     *
     * @param  string  $senderIdentification  Sender identification number (RNC).
     * @param  string  $sequenceNumber  Sequence number of the invoice (e-NCF).
     * @param  string  $totalAmount  Total amount of the invoice.
     * @param  string  $securityCode  Security code of the invoice.
     * @param  string  $releaseDate  Release date of the invoice (DD-MM-YYYY).
     * @param  string  $signatureDate  Signature date of the invoice (DD-MM-YYYY HH:MM:SS).
     * @param  string|null  $buyerIdentification  Optional buyer identification number (RNC/Cédula).
     * @param  string|null  $env  The environment (testecf, certecf, ecf).
     * @return string Full URL for the QR code verification.
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
     * Generate the link for the QR stamp verification for consumption invoices (RFCE).
     *
     * Flow: Take raw summary attributes -> Resolve domain from config -> Build query string -> Return full URL.
     *
     * @param  string  $senderIdentification  Sender identification number (RNC).
     * @param  string  $sequenceNumber  Sequence number of the summary (e-NCF).
     * @param  string  $totalAmount  Total amount.
     * @param  string  $securityCode  Security code.
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

    /**
     * Resolve the appropriate QR link from an InvoiceXml object.
     *
     * Flow: Extract metadata from InvoiceXml -> Detect document type (Standard vs Consumption) -> Delegate to specific resolver -> Return URL.
     *
     * @param  InvoiceXml  $invoiceXml  The invoice XML data object.
     * @param  string|null  $env  Target environment.
     * @return string The resolved verification URL.
     */
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
