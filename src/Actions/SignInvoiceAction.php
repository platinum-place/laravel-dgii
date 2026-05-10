<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceData;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;
use PlatinumPlace\LaravelDgii\Services\DgiiInvoiceXmlParser;
use PlatinumPlace\LaravelDgii\Services\DgiiQrResolver;
use PlatinumPlace\LaravelDgii\Services\XmlSigner;

class SignInvoiceAction
{
    /**
     * Create a new validate certificate action instance.
     */
    public function __construct(
        protected ValidateCertAction $validateCert,
        protected DgiiInvoiceXmlParser $xmlParser,
        protected XmlSigner $xmlSigner,
        protected StorageRepository $storage,
        protected DgiiQrResolver $qrResolver,
    ) {
        //
    }

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

        $qrLink = $this->qrResolver->getInvoiceQrLink($invoiceObject, $env);

        return new InvoiceData(
            $invoiceObject,
            $invoicePath,
            $qrLink,
            $integralObject ?? null,
            $integralPath ?? null,
            null,
            null,
        );
    }
}
