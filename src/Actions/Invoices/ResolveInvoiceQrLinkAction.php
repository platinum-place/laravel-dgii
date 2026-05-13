<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoices;

use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;

/**
 * Resolves the official DGII QR link for an electronic invoice.
 */
class ResolveInvoiceQrLinkAction
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Generate a QR link for a standard e-CF.
     */
    public function getInvoiceQrLink(string $senderIdentification, string $sequenceNumber, string $totalAmount, string $securityCode, string $releaseDate, string $signatureDate, ?string $buyerIdentification = null, ?string $env = null): string
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

    /**
     * Generate a QR link for a Consumption Invoice Summary (RFCE).
     */
    public function getConsumeInvoiceQrLink(string $senderIdentification, string $sequenceNumber, string $totalAmount, string $securityCode, ?string $env = null): string
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
            config('dgii.domains.consume_invoice'),
            $env,
            config('dgii.endpoints.consume_invoice.qr'),
            http_build_query($parameters)
        );
    }

    /**
     * Resolve the appropriate QR link based on the invoice type.
     */
    public function handle(InvoiceXml $invoiceXml, ?string $env = null): string
    {
        $senderIdentification = $invoiceXml->getSenderIdentification();
        $sequenceNumber = $invoiceXml->getSequenceNumber();
        $totalAmount = $invoiceXml->getTotalAmount();
        $securityCode = $invoiceXml->getSecurityCode();
        $releaseDate = $invoiceXml->getReleaseDate();
        $signatureDate = $invoiceXml->getSignatureDate();
        $buyerIdentification = $invoiceXml->getBuyerIdentification();

        if ($invoiceXml->isConsumeInvoice()) {
            return $this->getConsumeInvoiceQrLink(
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
