<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceData;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;
use PlatinumPlace\LaravelDgii\Services\DgiiInvoiceXmlParser;
use PlatinumPlace\LaravelDgii\Services\DgiiQrResolver;
use PlatinumPlace\LaravelDgii\Services\XmlSigner;

/**
 * Class SignInvoiceAction
 *
 * This action is responsible for transforming raw invoice data into a valid XML structure,
 * applying the digital signature, and saving the resulting file. It also handles
 * the generation of the "Integral" XML for consume invoices when necessary.
 */
class SignInvoiceAction
{
    /**
     * Create a new sign invoice action instance.
     */
    public function __construct(
        protected XmlSigner $xmlSigner,
        protected DgiiInvoiceXmlParser $xmlParser,
        protected StorageRepository $storage,
        protected DgiiQrResolver $qrResolver,
    ) {
        //
    }

    /**
     * Handle the invoice signing process.
     *
     * Execution Flow:
     * 1. Validate: Verify that the digital certificate is valid and accessible.
     * 2. Parse: Convert the input data array into the initial XML format.
     * 3. Sign & Store: Apply the digital signature to the XML and save it to storage.
     * 4. Consume Logic: If the invoice is a "Consume Invoice" (B02), it generates and signs an additional "Integral" XML.
     * 5. QR Link: Resolve the official DGII QR code link for the document.
     */
    public function handle(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        $this->xmlSigner->validateCertificate($certPath, $certPassword);

        $invoiceXml = $this->xmlParser->makeInvoice($data);

        $invoiceSigned = $this->xmlSigner->sign($invoiceXml, $certPath, $certPassword);

        $invoiceObject = new InvoiceXml($invoiceSigned);

        $invoicePath = $this->storage->save($invoiceSigned,$invoiceObject->getXmlName());

        if ($invoiceObject->isConsumeInvoice()) {
            $integralXml = $invoiceXml;

            $integralSigned = $invoiceSigned;

            $integralObject = $invoiceObject;

            $integralPath = $invoicePath;

            $invoiceXml = $this->xmlParser->makeConsumeInvoice($integralObject, $data);

            $invoiceSigned = $this->xmlSigner->sign($invoiceXml, $certPath, $certPassword);

            $invoiceObject = new InvoiceXml($invoiceSigned);

            $invoicePath = $this->storage->save($invoiceSigned,$invoiceObject->getXmlName());
        }

        $qrLink = $this->qrResolver->getInvoiceQrLink($invoiceObject, $env);

        return new InvoiceData(
            $invoiceObject,
            $invoicePath,
            $qrLink,
            $integralObject ?? null,
            $integralPath ?? null,
        );
    }
}
