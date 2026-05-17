<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoices\Orchestrators;

use Illuminate\Http\Client\ConnectionException;
use PlatinumPlace\LaravelDgii\Actions\Acknowledgments\Orchestrators\ProcessAcknowledgmentAction;
use PlatinumPlace\LaravelDgii\Actions\Auth\Orchestrators\ResolveAccessToken;
use PlatinumPlace\LaravelDgii\Actions\Xmls\Orchestrators\ValidateCertificateAction;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceData;
use PlatinumPlace\LaravelDgii\Exceptions\DgiiRepositoryException;
use PlatinumPlace\LaravelDgii\Repositories\ConsumerInvoiceRepository;
use PlatinumPlace\LaravelDgii\Repositories\InvoiceRepository;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;

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
        protected ConsumerInvoiceRepository $consumerRepository,
        protected ProcessAcknowledgmentAction $processAcknowledgment,
    ) {
        //
    }

    public function handle(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        $this->validateCertificate->handle($certPath, $certPassword);

        $object = $this->signInvoice->handle($data, $env, $certPath, $certPassword);

        $xml = $object->xml;

        $path = $object->path;

        $filePath = $this->storage->realPath($path);

        $token = $this->accessToken->handle($env, $certPath, $certPassword);

        $response = $xml->isConsumerInvoice() ?
            $this->consumerRepository->sendConsumerInvoice($token, $filePath, $env) :
            $this->invoiceRepository->sendInvoice($token, $filePath, $env);

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
