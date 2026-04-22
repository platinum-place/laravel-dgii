<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoice;

use PlatinumPlace\LaravelDgii\Clients\ConsumeInvoiceClient;
use PlatinumPlace\LaravelDgii\Clients\InvoiceClient;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;

/**
 * Generates the official verification QR link (fiscal stamp) for an e-CF.
 */
class GenerateInvoiceQrAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected StorageRepository $storageRepository,
        protected InvoiceClient $invoiceClient,
        protected ConsumeInvoiceClient $consumeInvoiceClient
    ) {
        //
    }

    public function handle(string $xmlPath, ?string $env = null): string
    {
        $xmlContent = $this->storageRepository->get($xmlPath);

        $invoiceXml = new InvoiceXml($xmlContent);

        $senderIdentification = $invoiceXml->getSenderIdentification();
        $sequenceNumber = $invoiceXml->getSequenceNumber();
        $totalAmount = $invoiceXml->getTotalAmount();
        $securityCode = $invoiceXml->getSecurityCode();
        $releaseDate = $invoiceXml->getReleaseDate();
        $signatureDate = $invoiceXml->getSignatureDate();
        $buyerIdentification = $invoiceXml->getBuyerIdentification();

        if ($invoiceXml->isConsumeInvoice()) {
            return $this->consumeInvoiceClient->fetchQRLink(
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

        return $this->invoiceClient->fetchQRLink(
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
