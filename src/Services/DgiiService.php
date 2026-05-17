<?php

namespace PlatinumPlace\LaravelDgii\Services;

use Illuminate\Http\Client\ConnectionException;
use PlatinumPlace\LaravelDgii\Actions\CancellationRanges\Orchestrators\SubmitCancellationRangeAction;
use PlatinumPlace\LaravelDgii\Actions\CommercialApprovals\Orchestrators\SubmitCommercialApprovalAction;
use PlatinumPlace\LaravelDgii\Actions\Invoices\Orchestrators\ReceiveInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\Invoices\Orchestrators\SendInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\Invoices\Orchestrators\SignInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\Invoices\Orchestrators\SignXmlInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\Invoices\Orchestrators\StorageInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\Invoices\Orchestrators\SubmitInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\Invoices\Orchestrators\ValidateInvoiceStatusAction;
use PlatinumPlace\LaravelDgii\Actions\Seeds\Orchestrators\ReceiveSeedAction;
use PlatinumPlace\LaravelDgii\Data\CancellationRange\CancellationRangeData;
use PlatinumPlace\LaravelDgii\Data\CommercialApproval\CommercialApprovalData;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceData;
use PlatinumPlace\LaravelDgii\Exceptions\DgiiRepositoryException;
use PlatinumPlace\LaravelDgii\Repositories\SeedRepository;
use PlatinumPlace\LaravelDgii\Repositories\StatusRepository;

class DgiiService
{
    /**
     * Create a new service instance.
     */
    public function __construct(
        protected SubmitCancellationRangeAction $submitCancellationRange,
        protected SubmitCommercialApprovalAction $submitCommercialApproval,
        protected SubmitInvoiceAction $submitInvoice,
        protected ValidateInvoiceStatusAction $validateInvoiceStatus,
        protected SendInvoiceAction $sendInvoice,
        protected StorageInvoiceAction $storageInvoice,
        protected SignInvoiceAction $signInvoice,
        protected SignXmlInvoiceAction $signXmlInvoice,
        protected ReceiveInvoiceAction $receiveInvoice,
        protected ReceiveSeedAction $receiveSeed,
        protected SeedRepository $seedRepository,
        protected StatusRepository $statusRepository,
    ) {
        //
    }

    public function sendCancellationRange(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): CancellationRangeData
    {
        return $this->submitCancellationRange->handle($data, $env, $certPath, $certPassword);
    }

    public function sendCommercialApproval(string $token, string $signed, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): CommercialApprovalData
    {
        return $this->submitCommercialApproval->handle($token, $signed, $env, $certPath, $certPassword);
    }

    public function submitInvoice(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        return $this->submitInvoice->handle($data, $env, $certPath, $certPassword);
    }

    public function validateInvoiceStatus(string $path, ?string $trackId = null, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        return $this->validateInvoiceStatus->handle($path, $trackId, $env, $certPath, $certPassword);
    }

    public function sendInvoice(string $path, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        return $this->sendInvoice->handle($path, $env, $certPath, $certPassword);
    }

    public function storageInvoice(string $signed, ?string $env = null): InvoiceData
    {
        return $this->storageInvoice->handle($signed, $env);
    }

    public function signInvoice(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        return $this->signInvoice->handle($data, $env, $certPath, $certPassword);
    }

    public function signXmlInvoice(string $xml, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        return $this->signXmlInvoice->handle($xml, $env, $certPath, $certPassword);
    }

    public function receiveInvoice(string $token, string $signed, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        return $this->receiveInvoice->handle($token, $signed, $env, $certPath, $certPassword);
    }

    /**
     * @throws ConnectionException
     */
    public function requestSeed(?string $env = null): string
    {
        return $this->seedRepository->getSeed($env);
    }

    /**
     * @throws ConnectionException
     */
    public function receiveSeed(string $xml, ?string $env = null): array
    {
        return $this->receiveSeed->handle($xml, $env);
    }

    /**
     * @throws ConnectionException
     */
    public function requestToken(string $path, ?string $env = null): array
    {
        return $this->seedRepository->getToken($path, $env);
    }

    /**
     * @throws ConnectionException
     */
    public function getServiceStatus(): array
    {
        return $this->statusRepository->getServiceStatus();
    }

    /**
     * @throws ConnectionException
     */
    public function getMaintenanceWindows(): array
    {
        return $this->statusRepository->getMaintenanceWindows();
    }

    /**
     * @throws ConnectionException
     */
    public function getEnvironmentStatus(string $env): array
    {
        return $this->statusRepository->getEnvironmentStatus($env);
    }
}
