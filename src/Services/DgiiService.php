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
     * Render an e-CF Invoice XML string.
     *
     * @param  array  $data  Invoice XML structured array
     * @return string
     *
     * @throws Throwable
     */
    public function renderInvoice(array $data): string
    {
        return $this->xmlRender->renderInvoice($data);
    }

    /**
     * Render a Consumer e-CF Invoice (RFCE) XML string.
     *
     * @param  string  $securityCode  Security code from the signed invoice signature
     * @param  array  $data           Invoice XML structured array
     * @return string
     *
     * @throws Throwable
     */
    public function renderConsumerInvoice(string $securityCode, array $data): string
    {
        return $this->xmlRender->renderConsumerInvoice($securityCode, $data);
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
     * Render a Cancellation Range (ANECF) XML string.
     *
     * @param  array  $data  Cancellation range structured array
     * @return string
     *
     * @throws Throwable
     */
    public function renderCancellationRange(array $data): string
    {
        return $this->xmlRender->renderCancellationRange($data);
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
        return $this->xmlRender->renderAcknowledgment(
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
     * Render a seed XML string.
     *
     * @param  string  $value  Seed value
     * @param  string  $date   Seed timestamp
     * @return string
     *
     * @throws Throwable
     */
    public function renderSeed(string $value, string $date): string
    {
        return $this->xmlRender->renderSeed($value, $date);
    }
}
