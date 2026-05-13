<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoices\Orchestrators;

use PlatinumPlace\LaravelDgii\Actions\Invoices\ResolveInvoiceQrLinkAction;
use PlatinumPlace\LaravelDgii\Actions\Xmls\Orchestrators\SignXmlAction;
use PlatinumPlace\LaravelDgii\Actions\Xmls\Orchestrators\ValidateCertificateAction;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceData;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;

/**
 * Orchestrates the signing of an already generated invoice XML.
 */
class SignXmlInvoiceAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected ValidateCertificateAction $validateCertificate,
        protected SignXmlAction $signXml,
        protected StorageRepository $storage,
        protected ResolveInvoiceQrLinkAction $qrResolver,
    ) {
        //
    }

    /**
     * Update the signing timestamp, sign the XML, and store it.
     *
     * Flow:
     * 1. Validate the digital certificate.
     * 2. Inject current date and time into the XML's FechaHoraFirma tag.
     * 3. Sign the XML using the digital certificate.
     * 4. Save the signed XML to storage.
     * 5. Resolve the QR link for the invoice.
     *
     * @throws \InvalidArgumentException
     */
    public function handle(string $xml, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        $this->validateCertificate->handle($certPath, $certPassword);

        $xml = preg_replace('/<FechaHoraFirma>.*?<\/FechaHoraFirma>/', '<FechaHoraFirma>'.date('d-m-Y H:i:s').'</FechaHoraFirma>', $xml);

        $signed = $this->signXml->handle($xml, $certPath, $certPassword);

        $object = new InvoiceXml($signed);

        $path = $this->storage->save($signed, $object->getXmlName());

        $qrLink = $this->qrResolver->handle($object, $env);

        return new InvoiceData($object, $path, $qrLink);
    }
}
