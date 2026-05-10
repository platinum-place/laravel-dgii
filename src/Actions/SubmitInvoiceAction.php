<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use Illuminate\Http\Client\ConnectionException;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceData;
use PlatinumPlace\LaravelDgii\Repositories\DgiiConsumeInvoiceRepository;
use PlatinumPlace\LaravelDgii\Repositories\DgiiInvoiceRepository;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;
use PlatinumPlace\LaravelDgii\Services\DgiiAuthenticator;
use PlatinumPlace\LaravelDgii\Services\XmlSigner;
use PlatinumPlace\LaravelDgii\Traits\InteractsWithInvoice;

/**
 * Class SubmitInvoiceAction
 *
 * This is the primary orchestrator for the entire electronic invoicing lifecycle.
 * it coordinates parsing, signing, storage, authentication, DGII submission,
 * and acknowledgment processing for a new invoice.
 */
class SubmitInvoiceAction
{
    use InteractsWithInvoice;

    /**
     * Create a new submit invoice action instance.
     */
    public function __construct(
        protected XmlSigner $xmlSigner,
        protected SignInvoiceAction $signInvoice,
        protected StorageRepository $storage,
        protected DgiiAuthenticator $authenticator,
        protected DgiiInvoiceRepository $invoiceRepository,
        protected DgiiConsumeInvoiceRepository $consumeRepository,
        protected ProcessAcknowledgmentAction $processAcknowledgment,
    ) {
        //
    }

    /**
     * Handle the full invoice submission lifecycle.
     *
     * Execution Flow:
     * 1. Sign: Transform raw data into a signed and stored XML using SignInvoiceAction.
     * 2. Authenticate: Obtain a security token from DGII.
     * 3. Submit: Send the signed invoice file to the appropriate DGII endpoint.
     * 4. Acknowledgment: Process the DGII's response to generate a signed acknowledgment XML.
     *
     * @throws ConnectionException
     */
    public function handle(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        $invoiceData = $this->signInvoice->handle($data, $env, $certPath, $certPassword);

        $filePath = $this->storage->realPath($invoiceData->path);

        $token = $this->authenticateAndGetToken($env, $certPath, $certPassword);

        $response = $this->sendInvoiceToDgii($invoiceData->xml, $filePath, $token, $env);

        $acknowledgmentObject = $this->processAcknowledgment->handle($invoiceData->xml, $response, $certPath, $certPassword);

        return new InvoiceData(
            $invoiceData->xml,
            $invoiceData->path,
            $invoiceData->qrLink,
            $invoiceData->integralXml,
            $invoiceData->integralPath,
            $response,
            $acknowledgmentObject,
        );
    }
}
