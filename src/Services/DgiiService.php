<?php

namespace PlatinumPlace\LaravelDgii\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use PlatinumPlace\LaravelDgii\Actions\ReceiveInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\SendInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\SignInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\StorageInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\SubmitCancellationRangeAction;
use PlatinumPlace\LaravelDgii\Actions\SubmitCommercialApprovalAction;
use PlatinumPlace\LaravelDgii\Actions\SubmitInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\ValidateInvoiceStatusAction;
use PlatinumPlace\LaravelDgii\Data\CancellationRange\CancellationRangeData;
use PlatinumPlace\LaravelDgii\Data\CommercialApproval\CommercialApprovalData;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceData;
use PlatinumPlace\LaravelDgii\Repositories\DgiiRepository;

/**
 * Main service to orchestrate e-CF operations and DGII interactions.
 *
 * This service coordinates the workflow for signing, submitting, validating, and
 * storing electronic fiscal documents by delegating to specific atomic actions.
 */
class DgiiService
{
    /**
     * Create a new service instance.
     *
     * @param  SubmitCancellationRangeAction  $submitCancellationRange  Orchestrates the submission of cancellation ranges.
     * @param  SubmitCommercialApprovalAction  $submitCommercialApproval  Orchestrates the submission of commercial approvals.
     * @param  SubmitInvoiceAction  $submitInvoice  Orchestrates the full flow of submitting an invoice (sign -> send -> response).
     * @param  ValidateInvoiceStatusAction  $validateInvoiceStatus  Checks the processing status of a submitted invoice at DGII.
     * @param  SendInvoiceAction  $sendInvoice  Handles submitting an invoice that was previously stored.
     * @param  StorageInvoiceAction  $storageInvoice  Manages the local persistence of signed XML documents.
     * @param  SignInvoiceAction  $signInvoice  Handles the digital signature process for XML content.
     * @param  ReceiveInvoiceAction  $receiveInvoice  Handles the submission of a signed invoice.
     * @param  DgiiRepository  $repository  Interface for direct communication with DGII SOAP/REST services.
     */
    public function __construct(
        protected SubmitCancellationRangeAction $submitCancellationRange,
        protected SubmitCommercialApprovalAction $submitCommercialApproval,
        protected SubmitInvoiceAction $submitInvoice,
        protected ValidateInvoiceStatusAction $validateInvoiceStatus,
        protected SendInvoiceAction $sendInvoice,
        protected StorageInvoiceAction $storageInvoice,
        protected SignInvoiceAction $signInvoice,
        protected ReceiveInvoiceAction $receiveInvoice,
        protected DgiiRepository $repository,
    ) {
        //
    }

    /**
     * Submit a range of sequences to be cancelled at DGII.
     *
     * Flow: Input array data -> Parse to ANECF XML -> Sign XML -> Submit to DGII -> Return received data.
     *
     * @param  array  $data  The cancellation range details.
     * @param  string|null  $env  Target environment (overrides config).
     * @param  string|null  $certPath  Custom path to the signing certificate.
     * @param  string|null  $certPassword  Password for the signing certificate.
     * @return CancellationRangeData The result of the submission.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function sendCancellationRange(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): CancellationRangeData
    {
        return $this->submitCancellationRange->handle($data, $env, $certPath, $certPassword);
    }

    /**
     * Submit a commercial approval response (AECF) for a received e-CF.
     *
     * Flow: Signed AECF XML -> Submit to DGII -> Return approval status data.
     *
     * @param  string  $token  The security token from DGII.
     * @param  string  $signed  The already signed AECF XML content.
     * @param  string|null  $env  Target environment (overrides config).
     * @param  string|null  $certPath  Custom path to the signing certificate.
     * @param  string|null  $certPassword  Password for the signing certificate.
     * @return CommercialApprovalData The result of the submission.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function sendCommercialApproval(string $token, string $signed, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): CommercialApprovalData
    {
        return $this->submitCommercialApproval->handle($token, $signed, $env, $certPath, $certPassword);
    }

    /**
     * Process and submit a new invoice (e-CF) to the DGII.
     *
     * Flow: Input data -> Generate XML -> Sign XML -> Authenticate -> Send to DGII -> Return track ID and status.
     *
     * @param  array  $data  Structured invoice data (mapped to e-CF schema).
     * @param  string|null  $env  Target environment (overrides config).
     * @param  string|null  $certPath  Custom path to the signing certificate.
     * @param  string|null  $certPassword  Password for the signing certificate.
     * @return InvoiceData The submission results including TrackId.
     *
     * @throws ConnectionException
     */
    public function submitInvoice(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        return $this->submitInvoice->handle($data, $env, $certPath, $certPassword);
    }

    /**
     * Validate the current status of a previously submitted invoice.
     *
     * Flow: Path/TrackId -> Query DGII status endpoint -> Parse response -> Return updated InvoiceData.
     *
     * @param  string  $path  Local path of the stored XML.
     * @param  string|null  $trackId  Optional TrackId if path is not enough.
     * @param  string|null  $env  Target environment (overrides config).
     * @param  string|null  $certPath  Custom path to the signing certificate.
     * @param  string|null  $certPassword  Password for the signing certificate.
     * @return InvoiceData The updated invoice status information.
     *
     * @throws ConnectionException
     */
    public function validateInvoiceStatus(string $path, ?string $trackId = null, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        return $this->validateInvoiceStatus->handle($path, $trackId, $env, $certPath, $certPassword);
    }

    /**
     * Send an already signed and stored invoice to DGII.
     *
     * Flow: Stored path -> Load XML -> Authenticate -> Send to DGII -> Return results.
     *
     * @param  string  $path  Local path of the stored XML file.
     * @param  string|null  $env  Target environment (overrides config).
     * @param  string|null  $certPath  Custom path to the signing certificate.
     * @param  string|null  $certPassword  Password for the signing certificate.
     * @return InvoiceData The result of the submission.
     *
     * @throws ConnectionException
     */
    public function sendInvoice(string $path, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        return $this->sendInvoice->handle($path, $env, $certPath, $certPassword);
    }

    /**
     * Store a signed XML document in the configured storage.
     *
     * @param  string  $signed  The signed XML content.
     * @param  string|null  $env  Environment context for storage organization.
     * @return InvoiceData Initial invoice data object with the saved path.
     */
    public function storageInvoice(string $signed, ?string $env = null): InvoiceData
    {
        return $this->storageInvoice->handle($signed, $env);
    }

    /**
     * Sign an invoice without submitting it.
     *
     * Flow: Input data -> Generate XML -> Sign XML -> Return signed data.
     *
     * @param  array  $data  Invoice data.
     * @param  string|null  $env  Environment context.
     * @param  string|null  $certPath  Custom path to the certificate.
     * @param  string|null  $certPassword  Certificate password.
     * @return InvoiceData Data object containing the signed XML.
     */
    public function signInvoice(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        return $this->signInvoice->handle($data, $env, $certPath, $certPassword);
    }

    /**
     * Receive and submit a signed invoice.
     *
     * @param  string  $token  The security token from DGII.
     * @param  string  $signed  The signed XML content.
     * @param  string|null  $env  The target environment.
     * @param  string|null  $certPath  Custom path to the certificate.
     * @param  string|null  $certPassword  Certificate password.
     *
     * @throws ConnectionException
     */
    public function receiveInvoice(string $token, string $signed, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        return $this->receiveInvoice->handle($token, $signed, $env, $certPath, $certPassword);
    }

    /**
     * Request a security seed (semilla) from the DGII.
     *
     * @param  string|null  $env  The target environment.
     * @return string The raw XML seed response.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function requestSeed(?string $env = null): string
    {
        return $this->repository->getSeed($env);
    }

    /**
     * Exchange a signed seed for an authentication token.
     *
     * @param  string  $path  Real path to the signed seed XML file.
     * @param  string|null  $env  The target environment.
     * @return array The authentication response (contains access_token and expires_in).
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function requestToken(string $path, ?string $env = null): array
    {
        return $this->repository->getToken($path, $env);
    }

    /**
     * Retrieve the general health status of the DGII web services.
     *
     * @param  string|null  $env  The environment to check.
     * @return array Status information.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getServiceStatus(?string $env = null): array
    {
        return $this->repository->getServiceStatus($env);
    }

    /**
     * Retrieve a list of scheduled maintenance windows from DGII.
     *
     * @param  string|null  $env  The environment to check.
     * @return array Maintenance schedule information.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getMaintenanceWindows(?string $env = null): array
    {
        return $this->repository->getMaintenanceWindows($env);
    }

    /**
     * Check the availability of a specific environment.
     *
     * @param  string|null  $env  The environment to check.
     * @return array Detailed environment status.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function getEnvironmentStatus(?string $env = null): array
    {
        return $this->repository->getEnvironmentStatus($env);
    }
}
