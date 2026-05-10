<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use Illuminate\Http\Client\ConnectionException;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceData;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\Repositories\DgiiConsumeInvoiceRepository;
use PlatinumPlace\LaravelDgii\Repositories\DgiiInvoiceRepository;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;
use PlatinumPlace\LaravelDgii\Services\DgiiAuthenticator;
use PlatinumPlace\LaravelDgii\Services\DgiiQrResolver;

class ValidateInvoiceStatusAction
{
    /**
     * Create a new validate certificate action instance.
     */
    public function __construct(
        protected ValidateCertAction $validateCert,
        protected StorageRepository $storage,
        protected DgiiAuthenticator $authenticator,
        protected DgiiInvoiceRepository $invoiceRepository,
        protected DgiiConsumeInvoiceRepository $consumeRepository,
        protected DgiiQrResolver $qrResolver,
    ) {
        //
    }

    /**
     * @throws ConnectionException
     */
    public function handle(string $path, ?string $trackId = null, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        $this->validateCert->handle($certPath, $certPassword);

        $signed = $this->storage->get($path);

        $object = new InvoiceXml($signed);

        $token = $this->authenticator->getToken($env, $certPath, $certPassword);

        $response = $object->isConsumeInvoice() ?
            $this->consumeRepository->find($token, $object, $env) :
            $this->invoiceRepository->findByTrackId($token, $trackId, $env);

        $qrLink = $this->qrResolver->getInvoiceQrLink($object, $env);

        return new InvoiceData(
            $object,
            null,
            $qrLink,
            null,
            null,
            $response,
            null,
        );
    }
}
