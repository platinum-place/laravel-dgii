<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoices\Orchestrators;

use PlatinumPlace\LaravelDgii\Actions\Acknowledgments\Orchestrators\ProcessAcknowledgmentAction;
use PlatinumPlace\LaravelDgii\Actions\Auth\Orchestrators\ResolveAccessToken;
use PlatinumPlace\LaravelDgii\Actions\Xmls\Orchestrators\ValidateCertificateAction;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceData;
use PlatinumPlace\LaravelDgii\Repositories\ConsumeInvoiceRepository;
use PlatinumPlace\LaravelDgii\Repositories\InvoiceRepository;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;

/**
 * Orchestrates the submission of an electronic invoice to the DGII.
 */
class SubmitInvoiceAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected ValidateCertificateAction $validateCertificate,
        protected SignInvoiceAction $signInvoice,
        protected StorageRepository $storage,
        protected ResolveAccessToken $accessToken,
        protected InvoiceRepository $invoiceRepository,
        protected ConsumeInvoiceRepository $consumeRepository,
        protected ProcessAcknowledgmentAction $processAcknowledgment,
    ) {
        //
    }

    /**
     * Handle the invoice submission process.
     *
     * Flow:
     * 1. Validate the digital certificate.
     * 2. Sign the invoice XML using the certificate.
     * 3. Store the signed XML in the local repository.
     * 4. Resolve a valid access token (via cache or DGII).
     * 5. Submit the XML to the DGII API (Standard or Consumption).
     * 6. Process and sign the DGII's acknowledgment response.
     */
    public function handle(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        $this->validateCertificate->handle($certPath, $certPassword);

        $object = $this->signInvoice->handle($data, $env, $certPath, $certPassword);

        $xml = $object->xml;

        $path = $object->path;

        $filePath = $this->storage->realPath($path);

        $token = $this->accessToken->handle($env, $certPath, $certPassword);

        $response = $xml->isConsumeInvoice() ?
            $this->consumeRepository->sendConsumeInvoice($token, $filePath, $env) :
            $this->invoiceRepository->send($token, $filePath, $env);

        $acknowledgmentObject = $this->processAcknowledgment->handle($xml, $response, $certPath, $certPassword);

        return new InvoiceData(
            $xml,
            $path,
            $object->qrLink,
            $object->integralXml,
            $object->integralPath,
            $response,
            $acknowledgmentObject,
        );
    }
}
