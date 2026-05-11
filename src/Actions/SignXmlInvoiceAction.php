<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceData;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;
use PlatinumPlace\LaravelDgii\Services\DgiiQrResolver;
use PlatinumPlace\LaravelDgii\Services\XmlSigner;

/**
 * Class SignXmlInvoiceAction
 *
 * This action handles the signing of an already generated XML invoice.
 * It applies the digital signature, stores the file, and resolves the QR link.
 */
class SignXmlInvoiceAction
{
    /**
     * Create a new sign xml invoice action instance.
     */
    public function __construct(
        protected XmlSigner $xmlSigner,
        protected StorageRepository $storage,
        protected DgiiQrResolver $qrResolver,
    ) {
        //
    }

    /**
     * Handle the process of signing a raw XML invoice.
     *
     * Execution Flow:
     * 1. Validate: Verify that the digital certificate is valid and accessible.
     * 2. Sign: Apply the digital signature to the provided XML string.
     * 3. Parse & Store: Create an InvoiceXml object and save the signed content to storage.
     * 4. QR Link: Resolve the official DGII QR code link for the document.
     *
     * @param  string  $xml  The raw XML content to be signed.
     * @param  string|null  $env  Target environment (overrides config).
     * @param  string|null  $certPath  Custom path to the signing certificate.
     * @param  string|null  $certPassword  Password for the signing certificate.
     * @return InvoiceData The resulting invoice data including the stored path.
     */
    public function handle(string $xml, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        $this->xmlSigner->validateCertificate($certPath, $certPassword);

        $xml = preg_replace('/<FechaHoraFirma>.*?<\/FechaHoraFirma>/', '<FechaHoraFirma>'.date('d-m-Y H:i:s').'</FechaHoraFirma>', $xml);

        $signed = $this->xmlSigner->sign($xml, $certPath, $certPassword);

        $object = new InvoiceXml($signed);

        $path = $this->storage->save($signed, $object->getXmlName());

        /**
         * TODO: Future implementation for Consume Invoices (E32).
         * If the XML is a consume invoice that exceeds the limit, an "Integral" XML should be generated.
         * This would require extracting data from the original XML or receiving it as an additional parameter.
         */
        $qrLink = $this->qrResolver->getInvoiceQrLink($object, $env);

        return new InvoiceData(
            $object,
            $path,
            $qrLink
        );
    }
}
