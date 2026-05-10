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

class SubmitInvoiceAction
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
    public function handle(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        $this->validateCert->handle($certPath, $certPassword);

        $invoiceXml = $this->xmlParser->makeInvoice($data);

        $invoiceSigned = $this->xmlSigner->sign($invoiceXml, $certPath, $certPassword);

        $invoiceObject = new InvoiceXml($invoiceSigned);

        $invoicePath = $this->storage->save($invoiceSigned);

        if ($invoiceObject->isConsumeInvoice()) {
            $integralXml = $invoiceXml;

            $integralSigned = $invoiceSigned;

            $integralObject = $invoiceObject;

            $integralPath = $invoicePath;

            $invoiceXml = $this->xmlParser->makeConsumeInvoice($integralObject, $data);

            $invoiceSigned = $this->xmlSigner->sign($invoiceXml, $certPath, $certPassword);

            $invoiceObject = new InvoiceXml($invoiceSigned);

            $invoicePath = $this->storage->save($invoiceSigned);
        }

        $filePath = $this->storage->realPath($invoicePath);

        $token = $this->authenticator->getToken($env, $certPath, $certPassword);

        $response = $invoiceObject->isConsumeInvoice() ?
            $this->consumeRepository->send($token, $filePath, $env) :
            $this->invoiceRepository->send($token, $filePath, $env);

        $qrLink = $this->qrResolver->getInvoiceQrLink($invoiceObject, $env);

        $acknowledgmentObject = $this->processAcknowledgment->handle($invoiceObject, $response, $certPath, $certPassword);

        return new InvoiceData(
            $invoiceObject,
            $invoicePath,
            $qrLink,
            $integralObject ?? null,
            $integralPath ?? null,
            $response,
            $acknowledgmentObject,
        );
    }
}
