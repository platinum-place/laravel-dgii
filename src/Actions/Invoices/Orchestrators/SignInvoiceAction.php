<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoices\Orchestrators;

use PlatinumPlace\LaravelDgii\Actions\Invoices\Mappers\MapConsumerInvoiceXmlAction;
use PlatinumPlace\LaravelDgii\Actions\Invoices\Mappers\MapInvoiceXmlAction;
use PlatinumPlace\LaravelDgii\Actions\Invoices\ResolveInvoiceQrLinkAction;
use PlatinumPlace\LaravelDgii\Actions\Xmls\Orchestrators\SignXmlAction;
use PlatinumPlace\LaravelDgii\Actions\Xmls\Orchestrators\ValidateCertificateAction;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceData;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;

/**
 * Orchestrates the generation and signing of an electronic invoice XML.
 */
class SignInvoiceAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected ValidateCertificateAction $validateCertificate,
        protected MapInvoiceXmlAction $InvoiceMapper,
        protected SignXmlAction $signXml,
        protected MapConsumerInvoiceXmlAction $ConsumerMapper,
        protected StorageRepository $storage,
        protected ResolveInvoiceQrLinkAction $qrResolver,
    ) {
        //
    }

    /**
     * Map raw data to XML, sign it, and handle consumer invoice logic if necessary.
     *
     * Flow:
     * 1. Validate the digital certificate.
     * 2. Map invoice data to XML using Blade templates.
     * 3. Sign the generated XML.
     * 4. Save the signed XML to storage.
     * 5. If it's a consumer invoice, generate and sign the summary XML.
     * 6. Resolve the QR link for the invoice.
     */
    public function handle(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        $this->validateCertificate->handle($certPath, $certPassword);

        $invoiceXml = $this->InvoiceMapper->handle($data);

        $invoiceSigned = $this->signXml->handle($invoiceXml, $certPath, $certPassword);

        $invoiceObject = new InvoiceXml($invoiceSigned);

        $invoicePath = $this->storage->save($invoiceSigned, $invoiceObject->getXmlName());

        if ($invoiceObject->isConsumerInvoice()) {
            $integralXml = $invoiceXml;

            $integralSigned = $invoiceSigned;

            $integralObject = $invoiceObject;

            $integralPath = $invoicePath;

            $invoiceXml = $this->ConsumerMapper->handle($integralObject, $data);

            $invoiceSigned = $this->signXml->handle($invoiceXml, $certPath, $certPassword);

            $invoiceObject = new InvoiceXml($invoiceSigned);

            $invoicePath = $this->storage->save($invoiceSigned, $invoiceObject->getXmlName());
        }

        $qrLink = $this->qrResolver->handle($invoiceObject, $env);

        return new InvoiceData(
            $invoiceObject,
            $invoicePath,
            $qrLink,
            $integralObject ?? null,
            $integralPath ?? null,
        );
    }
}
