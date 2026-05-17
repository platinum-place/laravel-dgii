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

    public function handle(string $token, string $signed, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        $object = new InvoiceXml($signed);

        $path = $this->storage->save($signed, $object->getXmlName());

        $filePath = $this->storage->realPath($path);

        $response = $this->repository->sendInvoice($token, $filePath, $env);

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
