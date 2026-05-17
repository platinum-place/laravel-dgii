<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoices\Orchestrators;

use Illuminate\Http\Client\ConnectionException;
use PlatinumPlace\LaravelDgii\Actions\Acknowledgments\Orchestrators\ProcessAcknowledgmentAction;
use PlatinumPlace\LaravelDgii\Actions\Auth\Orchestrators\ResolveAccessToken;
use PlatinumPlace\LaravelDgii\Actions\Invoices\ResolveInvoiceQrLinkAction;
use PlatinumPlace\LaravelDgii\Actions\Xmls\Orchestrators\ValidateCertificateAction;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceData;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\Exceptions\DgiiRepositoryException;
use PlatinumPlace\LaravelDgii\Repositories\ConsumerInvoiceRepository;
use PlatinumPlace\LaravelDgii\Repositories\InvoiceRepository;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;

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
        protected ConsumerInvoiceRepository $consumerRepository,
        protected ResolveInvoiceQrLinkAction $qrResolver,
        protected ProcessAcknowledgmentAction $processAcknowledgment,
    ) {
        //
    }

    public function handle(string $path, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        $this->storage->ifExists($path);

        $signed = $this->storage->get($path);

        $object = new InvoiceXml($signed);

        $filePath = $this->storage->realPath($path);

        $token = $this->accessToken->handle($env, $certPath, $certPassword);

        $response = $object->isConsumerInvoice() ?
            $this->consumerRepository->sendConsumerInvoice($token, $filePath, $env) :
            $this->invoiceRepository->sendInvoice($token, $filePath, $env);

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
