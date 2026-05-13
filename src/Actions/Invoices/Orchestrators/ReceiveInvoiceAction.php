<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoices\Orchestrators;

use Illuminate\Http\Client\ConnectionException;
use PlatinumPlace\LaravelDgii\Actions\Acknowledgments\Orchestrators\ProcessAcknowledgmentAction;
use PlatinumPlace\LaravelDgii\Actions\Invoices\ResolveInvoiceQrLinkAction;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceData;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\Exceptions\DgiiRepositoryException;
use PlatinumPlace\LaravelDgii\Repositories\InvoiceRepository;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;

/**
 * Orchestrates the reception of a signed invoice from a third party.
 */
class ReceiveInvoiceAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected StorageRepository $storage,
        protected InvoiceRepository $repository,
        protected ResolveInvoiceQrLinkAction $qrResolver,
        protected ProcessAcknowledgmentAction $processAcknowledgment,
    ) {
        //
    }

    /**
     * Store, submit, and process the acknowledgment for a received invoice.
     *
     * Flow:
     * 1. Initialize the InvoiceXml object from the signed string.
     * 2. Save the signed XML to the local storage.
     * 3. Submit the file to the DGII API using the provided token.
     * 4. Resolve the QR link for the invoice.
     * 5. Process and sign the DGII's acknowledgment response.
     *
     * @throws DgiiRepositoryException
     * @throws ConnectionException
     * @throws \InvalidArgumentException
     */
    public function handle(string $token, string $signed, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        $object = new InvoiceXml($signed);

        $path = $this->storage->save($signed, $object->getXmlName());

        $filePath = $this->storage->realPath($path);

        $response = $this->repository->send($token, $filePath, $env);

        $qrLink = $this->qrResolver->handle($object, $env);

        $acknowledgmentObject = $this->processAcknowledgment->handle($object, $response, $certPath, $certPassword);

        return new InvoiceData(
            $object,
            $path,
            $qrLink,
            response: $response,
            acknowledgment: $acknowledgmentObject,
        );
    }
}
