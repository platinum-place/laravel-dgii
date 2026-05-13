<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoices\Orchestrators;

use PlatinumPlace\LaravelDgii\Actions\Acknowledgments\Orchestrators\ProcessAcknowledgmentAction;
use PlatinumPlace\LaravelDgii\Actions\Auth\Orchestrators\ResolveAccessToken;
use PlatinumPlace\LaravelDgii\Actions\Invoices\ResolveInvoiceQrLinkAction;
use PlatinumPlace\LaravelDgii\Actions\Xmls\Orchestrators\ValidateCertificateAction;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceData;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\Repositories\ConsumeInvoiceRepository;
use PlatinumPlace\LaravelDgii\Repositories\InvoiceRepository;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;

/**
 * Orchestrates the sending of an already signed invoice to the DGII.
 */
class SendInvoiceAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected ValidateCertificateAction $validateCertificate,
        protected StorageRepository $storage,
        protected ResolveAccessToken $accessToken,
        protected InvoiceRepository $invoiceRepository,
        protected ConsumeInvoiceRepository $consumeRepository,
        protected ResolveInvoiceQrLinkAction $qrResolver,
        protected ProcessAcknowledgmentAction $processAcknowledgment,
    ) {
        //
    }

    /**
     * Send a signed XML file to the DGII and process the response.
     *
     * Flow:
     * 1. Check if the signed XML file exists in storage.
     * 2. Load the signed XML content.
     * 3. Resolve a valid access token.
     * 4. Submit the XML to the DGII API (Standard or Consumption).
     * 5. Resolve the QR link for the invoice.
     * 6. Process and sign the DGII's acknowledgment response.
     */
    public function handle(string $path, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        $this->storage->ifExists($path);

        $signed = $this->storage->get($path);

        $object = new InvoiceXml($signed);

        $filePath = $this->storage->realPath($path);

        $token = $this->accessToken->handle($env, $certPath, $certPassword);

        $response = $object->isConsumeInvoice() ?
            $this->consumeRepository->sendConsumeInvoice($token, $filePath, $env) :
            $this->invoiceRepository->send($token, $filePath, $env);

        $qrLink = $this->qrResolver->handle($object, $env);

        $acknowledgmentObject = $this->processAcknowledgment->handle($object, $response, $certPath, $certPassword);

        return new InvoiceData(
            xml: $object,
            path: $path,
            qrLink: $qrLink,
            response: $response,
            acknowledgment: $acknowledgmentObject,
        );
    }
}
