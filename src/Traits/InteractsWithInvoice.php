<?php

namespace PlatinumPlace\LaravelDgii\Traits;

use Illuminate\Http\Client\ConnectionException;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceReceived;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;

trait InteractsWithInvoice
{
    /**
     * Authenticate and get a token for DGII services.
     */
    protected function authenticateAndGetToken(?string $env = null, ?string $certPath = null, ?string $certPassword = null): string
    {
        $this->xmlSigner->validateCertificate($certPath, $certPassword);

        return $this->authenticator->getToken($env, $certPath, $certPassword);
    }

    /**
     * Send an invoice (standard or consumer) to DGII.
     *
     * @throws ConnectionException
     */
    protected function sendInvoice(InvoiceXml $object, string $filePath, string $token, ?string $env = null): InvoiceReceived
    {
        return $object->isConsumeInvoice() ?
            $this->consumeRepository->send($token, $filePath, $env) :
            $this->invoiceRepository->send($token, $filePath, $env);
    }

    /**
     * Find the status of an invoice in DGII.
     *
     * @throws ConnectionException
     */
    protected function findInvoiceStatus(InvoiceXml $object, string $token, ?string $trackId = null, ?string $env = null): InvoiceReceived
    {
        return $object->isConsumeInvoice() ?
            $this->consumeRepository->find($token, $object, $env) :
            $this->invoiceRepository->findByTrackId($token, $trackId, $env);
    }
}
