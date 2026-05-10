<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use Illuminate\Http\Client\ConnectionException;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceData;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\Repositories\DgiiConsumeInvoiceRepository;
use PlatinumPlace\LaravelDgii\Repositories\DgiiInvoiceRepository;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;
use PlatinumPlace\LaravelDgii\Services\DgiiAuthenticator;
use PlatinumPlace\LaravelDgii\Services\DgiiInvoiceXmlParser;
use PlatinumPlace\LaravelDgii\Services\DgiiQrResolver;
use PlatinumPlace\LaravelDgii\Services\XmlSigner;

class ResendInvoiceAction
{
    /**
     * Create a new validate certificate action instance.
     */
    public function __construct(
        protected ValidateCertAction $validateCert,
        protected DgiiInvoiceXmlParser $xmlParser,
        protected XmlSigner $xmlSigner,
        protected StorageRepository $storage,
        protected DgiiAuthenticator $authenticator,
        protected DgiiInvoiceRepository $invoiceRepository,
        protected DgiiConsumeInvoiceRepository $consumeRepository,
        protected DgiiQrResolver $qrResolver,
        protected ProcessAcknowledgmentAction $processAcknowledgment,
    ) {
        //
    }

    /**
     * @throws ConnectionException
     */
    public function handle(string $path, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        $this->validateCert->handle($certPath, $certPassword);

        $signed = $this->storage->get($path);

        $object = new InvoiceXml($signed);

        $filePath = $this->storage->realPath($path);

        $token = $this->authenticator->getToken($env, $certPath, $certPassword);

        $response = $object->isConsumeInvoice() ?
            $this->consumeRepository->send($token, $filePath, $env) :
            $this->invoiceRepository->send($token, $filePath, $env);

        $qrLink = $this->qrResolver->getInvoiceQrLink($object, $env);

        $acknowledgmentObject = $this->processAcknowledgment->handle($object, $response, $certPath, $certPassword);

        return new InvoiceData(
            $object,
            $path,
            $qrLink,
            null,
            null,
            $response,
            $acknowledgmentObject,
        );
    }
}
