<?php

namespace PlatinumPlace\LaravelDgii\Repositories;

use Illuminate\Support\Collection;
use PlatinumPlace\LaravelDgii\Actions\AuthenticateAction;
use PlatinumPlace\LaravelDgii\Clients\ConsumeInvoiceClient;
use PlatinumPlace\LaravelDgii\Clients\InvoiceClient;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceReceived;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\Support\StorageService;

/**
 * Client to interact with DGII e-CF (Electronic Invoice) Services.
 *
 * This class handles the transmission of signed e-CF documents and
 * provides methods to query their status and tracking information.
 */
class InvoiceRepository
{
    use HandlesDgiiResponse;

    /**
     * Create a new client instance.
     */
    public function __construct(
        protected StorageService       $storageService,
        protected InvoiceClient        $invoiceClient,
        protected ConsumeInvoiceClient $consumeInvoiceClient,
        protected AuthenticateAction   $authenticateAction,
    )
    {
        //
    }

    public function send(string $xmlPath, ?string $env = null, ?string $certPath = null, ?string $certPassword = null, ?string $token = null): InvoiceReceived
    {
        $filePath = $this->storageService->path($xmlPath);

        $xmlContent = $this->storageService->get($xmlPath);

        $invoiceXml = new InvoiceXml($xmlContent);

        [$response, $status] = $this->handleResponse(function () use ($invoiceXml, $filePath, $env, $certPath, $certPassword, $token) {
            if (!$token) {
                $token = $this->authenticateAction->handle($env, $certPath, $certPassword);
            }

            return $invoiceXml->isConsumeInvoice()
                ? $this->consumeInvoiceClient->send($token, $filePath, $env)
                : $this->invoiceClient->send($token, $filePath, $env);
        });

        return new InvoiceReceived($response, $status);
    }

    public function getByTrackId(string $trackId, ?string $env = null, ?string $certPath = null, ?string $certPassword = null, ?string $token = null): InvoiceReceived
    {
        [$response, $status] = $this->handleResponse(function () use ($trackId, $env, $certPath, $certPassword, $token) {
            $token = $this->authenticateAction->handle($env, $certPath, $certPassword);

            return $this->invoiceClient->fetchStatusByTrackId($token, $trackId, $env);
        });

        return new InvoiceReceived($response, $status);
    }

    public function getList(string $xmlPath, ?string $env = null, ?string $certPath = null, ?string $certPassword = null, ?string $token = null): Collection
    {
        $xmlContent = $this->storageService->get($xmlPath);

        $invoiceXml = new InvoiceXml($xmlContent);

        [$response] = $this->handleResponse(function () use ($invoiceXml, $env, $certPath, $certPassword, $token) {
            $token = $this->authenticateAction->handle($env, $certPath, $certPassword);

            return $this->invoiceClient->fetchTrackIdList(
                $token,
                $invoiceXml->getSenderIdentification(),
                $invoiceXml->getSequenceNumber(),
                $env
            );
        });

        return collect($response);
    }

    public function getQRLink(string $xmlPath, ?string $env = null): string
    {
        $xmlContent = $this->storageService->get($xmlPath);

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

    public function getByXml(string $xmlPath, ?string $trackId = null, ?string $env = null, ?string $certPath = null, ?string $certPassword = null, ?string $token = null): InvoiceReceived
    {
        $xmlContent = $this->storageService->get($xmlPath);

        $invoiceXml = new InvoiceXml($xmlContent);

        $senderIdentification = $invoiceXml->getSenderIdentification();
        $sequenceNumber = $invoiceXml->getSequenceNumber();
        $buyerIdentification = $invoiceXml->getBuyerIdentification();
        $securityCode = $invoiceXml->getSecurityCode();

        [$response, $status] = $this->handleResponse(function () use ($invoiceXml, $trackId, $senderIdentification, $sequenceNumber, $buyerIdentification, $securityCode, $env, $certPath, $certPassword, $token) {
            $token = $this->authenticateAction->handle($env, $certPath, $certPassword);

            return $invoiceXml->isConsumeInvoice()
                ? $this->consumeInvoiceClient->fetchStatus(
                    $token,
                    $senderIdentification,
                    $sequenceNumber,
                    $securityCode,
                    $env
                )
                :
//                $this->invoiceClient->fetchStatus(
//                    $token,
//                    $senderIdentification,
//                    $sequenceNumber,
//                    $buyerIdentification,
//                    $securityCode,
//                    $env
//                );
                $this->invoiceClient->fetchStatusByTrackId(
                    $token,
                    $trackId,
                    $env
                );
        });

        return new InvoiceReceived($response, $status);
    }
}
