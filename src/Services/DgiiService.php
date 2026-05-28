<?php

namespace PlatinumPlace\LaravelDgii\Services;

use Illuminate\Http\Client\ConnectionException;
use Throwable;

class DgiiService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected DgiiClient    $client,
        protected DgiiXmlRender $xmlRender,
    )
    {
        //
    }

    /**
     * Fetch a raw seed XML string from DGII.
     *
     * @throws ConnectionException
     */
    public function getSeed(string $env): string
    {
        return $this->client->fetchAuthSeed($env);
    }

    /**
     * Submit a signed seed XML file to DGII to get the access token.
     *
     * @throws ConnectionException
     */
    public function verifySeed(string $env, string $filePath): array
    {
        return $this->client->sendAuthSeed($env, $filePath);
    }

    /**
     * Render and digitally sign an e-CF Invoice XML string.
     * @throws Throwable
     */
    public function renderInvoice(string $certContent, string $certPassword, array $data): array
    {
        $type = (int)$data['IdDoc']['TipoeCF'];
        $total = (float)$data['Totales']['MontoTotal'];

        $consumeType = (int)config('dgii.rules.consumer_invoice_type');
        $consumeLimit = (float)config('dgii.rules.consumer_invoice_limit');

        if ($type === $consumeType && $total < $consumeLimit) {
            return $this->xmlRender->renderConsumerInvoice($certContent, $certPassword, $data);
        }

        return [
            'xml' => $this->xmlRender->renderInvoice($certContent, $certPassword, $data),
            'integral' => null,
        ];
    }

    /**
     * Submit a signed e-CF Invoice XML file to DGII.
     *
     * @throws ConnectionException
     */
    public function sendInvoice(string $env, string $token, string $filePath): array
    {
        return $this->client->sendInvoice($env, $token, $filePath);
    }

    /**
     * Query the status of an e-CF using its trackId.
     *
     * @throws ConnectionException
     */
    public function findInvoice(string $env, string $token, string $trackId): array
    {
        return $this->client->findInvoiceByTrackId($env, $token, $trackId);
    }

    /**
     * Query available trackIds for a specific sender and sequence.
     *
     * @throws ConnectionException
     */
    public function fetchInvoices(string $env, string $token, string $senderIdentification, string $sequenceNumber): array
    {
        return $this->client->fetchInvoices($env, $token, $senderIdentification, $sequenceNumber);
    }

    /**
     * Submit a signed Consumer e-CF Invoice XML file to DGII.
     *
     * @throws ConnectionException
     */
    public function sendConsumerInvoice(string $env, string $token, string $filePath): array
    {
        return $this->client->sendConsumerInvoice($env, $token, $filePath);
    }

    /**
     * Query the status of a Consumer e-CF.
     *
     * @throws ConnectionException
     */
    public function fetchConsumerInvoice(string $env, string $token, string $senderIdentification, string $sequenceNumber, string $securityCode): array
    {
        return $this->client->fetchConsumerInvoice($env, $token, $senderIdentification, $sequenceNumber, $securityCode);
    }

    /**
     * Render and digitally sign a Cancellation Range (ANECF) XML.
     * @throws Throwable
     */
    public function renderCancellationRange(string $certContent, string $certPassword, array $data): string
    {
        return $this->xmlRender->renderCancellationRange($certContent, $certPassword, $data);
    }

    /**
     * Submit a signed Cancellation Range XML file to DGII.
     *
     * @throws ConnectionException
     */
    public function sendCancellationRange(string $env, string $token, string $filePath): array
    {
        return $this->client->sendCancellationRange($env, $token, $filePath);
    }

    /**
     * Submit a signed Commercial Approval XML file to DGII.
     *
     * @throws ConnectionException
     */
    public function sendCommercialApproval(string $env, string $token, string $filePath): array
    {
        return $this->client->sendCommercialApproval($env, $token, $filePath);
    }

    /**
     * Render and digitally sign an Acknowledgment of Receipt (ARECF) XML.
     * @throws Throwable
     */
    public function renderAcknowledgment(
        string  $certContent,
        string  $certPassword,
        string  $senderIdentification,
        string  $buyerIdentification,
        string  $sequenceNumber,
        string  $status,
        ?string $notReceivedCode = null
    ): string
    {
        return $this->xmlRender->renderAcknowledgment(
            $certContent,
            $certPassword,
            $senderIdentification,
            $buyerIdentification,
            $sequenceNumber,
            $status,
            $notReceivedCode
        );
    }

    /**
     * Get the general operational status of DGII services.
     *
     * @throws ConnectionException
     */
    public function getServiceStatus(): array
    {
        return $this->client->fetchServiceStatus();
    }

    /**
     * Get maintenance window schedules published by DGII.
     *
     * @throws ConnectionException
     */
    public function getMaintenanceWindows(): array
    {
        return $this->client->fetchMaintenanceWindows();
    }

    /**
     * Check the active status of a specific environment in DGII.
     *
     * @throws ConnectionException
     */
    public function getEnvironmentStatus(string $env): array
    {
        return $this->client->fetchEnvironmentStatus($env);
    }

    /**
     * Render and digitally sign a seed XML string.
     * @throws Throwable
     */
    public function renderSeed(string $value, string $date): string
    {
        return $this->xmlRender->renderSeed($value, $date);
    }
}
