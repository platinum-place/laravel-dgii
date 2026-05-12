<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use PlatinumPlace\LaravelDgii\Data\Acknowledgment\AcknowledgmentData;
use PlatinumPlace\LaravelDgii\Data\Acknowledgment\AcknowledgmentXml;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceResponse;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;
use PlatinumPlace\LaravelDgii\Services\AcknowledgmentXmlParser;
use PlatinumPlace\LaravelDgii\Services\XmlSigner;

/**
 * Class ProcessAcknowledgmentAction
 *
 * This action is responsible for generating, signing, and storing the
 * Acknowledgment (Acuse de Recibo) XML based on the response received
 * from the DGII after an invoice submission.
 */
class ProcessAcknowledgmentAction
{
    /**
     * Create a new process acknowledgment action instance.
     */
    public function __construct(
        protected AcknowledgmentXmlParser $xmlParser,
        protected XmlSigner $xmlSigner,
        protected StorageRepository $storage,
    ) {
        //
    }

    /**
     * Handle the acknowledgment process.
     *
     * Execution Flow:
     * 1. Parse: Generate the acknowledgment XML structure from the original invoice and the DGII response.
     * 2. Sign: Apply the digital signature to the generated XML.
     * 3. Store: Save the signed acknowledgment XML to the configured storage.
     */
    public function handle(InvoiceXml $invoiceXml, InvoiceResponse $invoiceReceived, ?string $certPath = null, ?string $certPassword = null): AcknowledgmentData
    {
        $xml = $this->xmlParser->make($invoiceXml, $invoiceReceived);

        $signed = $this->xmlSigner->sign($xml, $certPath, $certPassword);

        $object = new AcknowledgmentXml($signed);

        $path = $this->storage->save($signed, $object->getXmlName());

        return new AcknowledgmentData($object, $path);
    }
}
