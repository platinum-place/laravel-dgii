<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoices\Orchestrators;

use Illuminate\Http\Client\ConnectionException;
use PlatinumPlace\LaravelDgii\Actions\Auth\Orchestrators\ResolveAccessToken;
use PlatinumPlace\LaravelDgii\Actions\Invoices\ResolveInvoiceQrLinkAction;
use PlatinumPlace\LaravelDgii\Actions\Xmls\Orchestrators\ValidateCertificateAction;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceData;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\Exceptions\DgiiRepositoryException;
use PlatinumPlace\LaravelDgii\Repositories\ConsumerInvoiceRepository;
use PlatinumPlace\LaravelDgii\Repositories\InvoiceRepository;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;

class ValidateInvoiceStatusAction
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
    ) {
        //
    }

    public function handle(string $path, ?string $trackId = null, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        $this->validateCertificate->handle($certPath, $certPassword);

        $this->storage->ifExists($path);

        $signed = $this->storage->get($path);

        $object = new InvoiceXml($signed);

        $token = $this->accessToken->handle($env, $certPath, $certPassword);

        $response = $object->isConsumerInvoice() ?
            $this->consumerRepository->findConsumerInvoice($token, $object, $env) :
            $this->invoiceRepository->findByTrackId($token, $trackId, $env);

        $qrLink = $this->qrResolver->handle($object, $env);

        return new InvoiceData(xml: $object, qrLink: $qrLink, response: $response);
    }
}
