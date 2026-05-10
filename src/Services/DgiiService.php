<?php

namespace PlatinumPlace\LaravelDgii\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use PlatinumPlace\LaravelDgii\Actions\ResendInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\SignInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\StorageInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\SubmitCancellationRangeAction;
use PlatinumPlace\LaravelDgii\Actions\SubmitCommercialApprovalAction;
use PlatinumPlace\LaravelDgii\Actions\SubmitInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\ValidateInvoiceStatusAction;
use PlatinumPlace\LaravelDgii\Data\CancellationRange\CancellationRangeData;
use PlatinumPlace\LaravelDgii\Data\CommercialApproval\CommercialApprovalData;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceData;
use PlatinumPlace\LaravelDgii\Repositories\DgiiServiceRepository;

/**
 * Service to manage general DGII service status and information.
 */
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
        protected ResendInvoiceAction $resendInvoice,
        protected StorageInvoiceAction $storageInvoice,
        protected SignInvoiceAction $signInvoice,
        protected DgiiServiceRepository $serviceRepository,
    ) {
        //
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function sendCancellationRange(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): CancellationRangeData
    {
        return $this->submitCancellationRange->handle($data, $env, $certPath, $certPassword);
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function sendCommercialApproval(string $signed, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): CommercialApprovalData
    {
        return $this->submitCommercialApproval->handle($signed, $env, $certPath, $certPassword);
    }

    /**
     * @throws ConnectionException
     */
    public function submitInvoice(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        return $this->submitInvoice->handle($data, $env, $certPath, $certPassword);
    }

    /**
     * @throws ConnectionException
     */
    public function validateInvoiceStatus(string $path, ?string $trackId = null, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        return $this->validateInvoiceStatus->handle($path, $trackId, $env, $certPath, $certPassword);
    }

    /**
     * @throws ConnectionException
     */
    public function resendInvoice(string $path, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        return $this->resendInvoice->handle($path, $env, $certPath, $certPassword);
    }

    public function storageInvoice(string $signed, ?string $env = null): InvoiceData
    {
        return $this->storageInvoice->handle($signed, $env);
    }

    public function signInvoice(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        return $this->signInvoice->handle($data, $env, $certPath, $certPassword);
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function requestSeed(?string $env = null): string
    {
        return $this->serviceRepository->getSeed($env);
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function requestToken(string $path, ?string $env = null): array
    {
        return $this->serviceRepository->getToken($path, $env);
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getServiceStatus(?string $env = null): array
    {
        return $this->serviceRepository->getServiceStatus($env);
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getMaintenanceWindows(?string $env = null): array
    {
        return $this->serviceRepository->getMaintenanceWindows($env);
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getEnvironmentStatus(?string $env = null): array
    {
        return $this->serviceRepository->getEnvironmentStatus($env);
    }
}
