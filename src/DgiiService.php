<?php

namespace PlatinumPlace\LaravelDgii;

use Illuminate\Http\Client\ConnectionException;
use PlatinumPlace\LaravelDgii\Actions\FetchAuthSeedAction;
use PlatinumPlace\LaravelDgii\Actions\FetchConsumerInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\FetchEnvironmentStatusAction;
use PlatinumPlace\LaravelDgii\Actions\FetchInvoicesAction;
use PlatinumPlace\LaravelDgii\Actions\FetchMaintenanceWindowsAction;
use PlatinumPlace\LaravelDgii\Actions\FetchServiceStatusAction;
use PlatinumPlace\LaravelDgii\Actions\FindInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\RenderAcknowledgmentXmlAction;
use PlatinumPlace\LaravelDgii\Actions\RenderCancellationRangeXmlAction;
use PlatinumPlace\LaravelDgii\Actions\RenderConsumerInvoiceXmlAction;
use PlatinumPlace\LaravelDgii\Actions\RenderInvoiceXmlAction;
use PlatinumPlace\LaravelDgii\Actions\SendAuthSeedAction;
use PlatinumPlace\LaravelDgii\Actions\SendCancellationRangeAction;
use PlatinumPlace\LaravelDgii\Actions\SendCommercialApprovalAction;
use PlatinumPlace\LaravelDgii\Actions\SendConsumerInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\SendInvoiceAction;

class DgiiService
{
    /**
     * Create a new service instance with constructor injection of all atomic actions.
     */
    public function __construct(
        protected FetchAuthSeedAction              $fetchAuthSeed,
        protected SendAuthSeedAction               $sendAuthSeed,
        protected RenderInvoiceXmlAction           $renderInvoiceXml,
        protected SendInvoiceAction                $sendInvoice,
        protected FindInvoiceAction                $findInvoice,
        protected FetchInvoicesAction              $fetchInvoices,
        protected RenderConsumerInvoiceXmlAction   $renderConsumerInvoiceXml,
        protected SendConsumerInvoiceAction        $sendConsumerInvoice,
        protected FetchConsumerInvoiceAction       $fetchConsumerInvoice,
        protected RenderCancellationRangeXmlAction $renderCancellationRangeXml,
        protected SendCancellationRangeAction      $sendCancellationRange,
        protected SendCommercialApprovalAction     $sendCommercialApproval,
        protected RenderAcknowledgmentXmlAction    $renderAcknowledgmentXml,
        protected FetchServiceStatusAction         $fetchServiceStatus,
        protected FetchMaintenanceWindowsAction    $fetchMaintenanceWindows,
        protected FetchEnvironmentStatusAction     $fetchEnvironmentStatus,
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
        return $this->fetchAuthSeed->handle($env);
    }

    /**
     * Submit a signed seed XML file to DGII to get the access token.
     *
     * @throws ConnectionException
     */
    public function verifySeed(string $env, string $filePath): array
    {
        return $this->sendAuthSeed->handle($env, $filePath);
    }

    /**
     * Render and digitally sign an e-CF Invoice XML string.
     */
    public function renderInvoice(string $certContent, string $certPassword, array $data): array
    {
        $type = (int)$data['IdDoc']['TipoeCF'];
        $total = (float)$data['Totales']['MontoTotal'];

        $consumeType = (int)config('dgii.rules.consumer_invoice_type');
        $consumeLimit = (float)config('dgii.rules.consumer_invoice_limit');

        if ($type === $consumeType && $total < $consumeLimit) {
            return $this->renderConsumerInvoiceXml->handle($certContent, $certPassword, $data);
        }

        return [
            'xml' => $this->renderInvoiceXml->handle($certContent, $certPassword, $data),
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
        return $this->sendInvoice->handle($env, $token, $filePath);
    }

    /**
     * Query the status of an e-CF using its trackId.
     *
     * @throws ConnectionException
     */
    public function findInvoice(string $env, string $token, string $trackId): array
    {
        return $this->findInvoice->handle($env, $token, $trackId);
    }

    /**
     * Query available trackIds for a specific sender and sequence.
     *
     * @throws ConnectionException
     */
    public function fetchInvoices(string $env, string $token, string $senderIdentification, string $sequenceNumber): array
    {
        return $this->fetchInvoices->handle($env, $token, $senderIdentification, $sequenceNumber);
    }

    /**
     * Submit a signed Consumer e-CF Invoice XML file to DGII.
     *
     * @throws ConnectionException
     */
    public function sendConsumerInvoice(string $env, string $token, string $filePath): array
    {
        return $this->sendConsumerInvoice->handle($env, $token, $filePath);
    }

    /**
     * Query the status of a Consumer e-CF.
     *
     * @throws ConnectionException
     */
    public function fetchConsumerInvoice(string $env, string $token, string $senderIdentification, string $sequenceNumber, string $securityCode): array
    {
        return $this->fetchConsumerInvoice->handle($env, $token, $senderIdentification, $sequenceNumber, $securityCode);
    }

    /**
     * Render and digitally sign a Cancellation Range (ANECF) XML.
     */
    public function renderCancellationRange(string $certContent, string $certPassword, array $data): string
    {
        return $this->renderCancellationRangeXml->handle($certContent, $certPassword, $data);
    }

    /**
     * Submit a signed Cancellation Range XML file to DGII.
     *
     * @throws ConnectionException
     */
    public function sendCancellationRange(string $env, string $token, string $filePath): array
    {
        return $this->sendCancellationRange->handle($env, $token, $filePath);
    }

    /**
     * Submit a signed Commercial Approval XML file to DGII.
     *
     * @throws ConnectionException
     */
    public function sendCommercialApproval(string $env, string $token, string $filePath): array
    {
        return $this->sendCommercialApproval->handle($env, $token, $filePath);
    }

    /**
     * Render and digitally sign an Acknowledgment of Receipt (ARECF) XML.
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
        return $this->renderAcknowledgmentXml->handle(
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
    public function getServiceStatus(string $apiKey): array
    {
        return $this->fetchServiceStatus->handle($apiKey);
    }

    /**
     * Get maintenance window schedules published by DGII.
     *
     * @throws ConnectionException
     */
    public function getMaintenanceWindows(string $apiKey): array
    {
        return $this->fetchMaintenanceWindows->handle($apiKey);
    }

    /**
     * Check the active status of a specific environment in DGII.
     *
     * @throws ConnectionException
     */
    public function getEnvironmentStatus(string $apiKey, string $env): array
    {
        return $this->fetchEnvironmentStatus->handle($apiKey, $env);
    }
}
