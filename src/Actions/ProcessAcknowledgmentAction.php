<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use PlatinumPlace\LaravelDgii\Data\Acknowledgment\AcknowledgmentData;
use PlatinumPlace\LaravelDgii\Data\Acknowledgment\AcknowledgmentXml;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceReceived;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;
use PlatinumPlace\LaravelDgii\Services\AcknowledgmentXmlParse;
use PlatinumPlace\LaravelDgii\Services\XmlSigner;

class ProcessAcknowledgmentAction
{
    /**
     * Create a new validate certificate action instance.
     */
    public function __construct(
        protected AcknowledgmentXmlParse $xmlParser,
        protected XmlSigner $xmlSigner,
        protected StorageRepository $storage,
    ) {
        //
    }

    public function handle(InvoiceXml $invoiceXml, InvoiceReceived $invoiceReceived, ?string $certPath = null, ?string $certPassword = null): AcknowledgmentData
    {
        $xml = $this->xmlParser->make($invoiceXml, $invoiceReceived);

        $signed = $this->xmlSigner->sign($xml, $certPath, $certPassword);

        $object = new AcknowledgmentXml($signed);

        $path = $this->storage->save($signed);

        return new AcknowledgmentData($object, $path);
    }
}
