<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use Illuminate\Http\Client\ConnectionException;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceData;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\Repositories\DgiiInvoiceRepository;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;
use PlatinumPlace\LaravelDgii\Services\DgiiQrResolver;

/**
 * Class ReceiveInvoiceAction
 *
 * This action handles the reception of a signed invoice and its submission to the DGII.
 * It coordinates storage, DGII submission, and acknowledgment processing.
 */
class ReceiveInvoiceAction
{
    /**
     * Create a new receive invoice action instance.
     */
    public function __construct(
        protected StorageRepository $storage,
        protected DgiiInvoiceRepository $repository,
        protected DgiiQrResolver $qrResolver,
        protected ProcessAcknowledgmentAction $processAcknowledgment,
    ) {
        //
    }

    /**
     * @throws ConnectionException
     */
    public function handle(string $token, string $signed, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        $object = new InvoiceXml($signed);

        $path = $this->storage->save($signed, $object->getXmlName());

        $filePath = $this->storage->realPath($path);

        $response = $this->repository->send($token, $filePath, $env);

        $qrLink = $this->qrResolver->getInvoiceQrLink($object, $env);

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
