<?php

namespace PlatinumPlace\LaravelDgii\Actions\Acknowledgments\Orchestrators;

use PlatinumPlace\LaravelDgii\Actions\Acknowledgments\Mappers\MapAcknowledgmentXmlAction;
use PlatinumPlace\LaravelDgii\Actions\Xmls\Orchestrators\SignXmlAction;
use PlatinumPlace\LaravelDgii\Data\Acknowledgment\AcknowledgmentData;
use PlatinumPlace\LaravelDgii\Data\Acknowledgment\AcknowledgmentXml;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceResponse;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;

class ProcessAcknowledgmentAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected MapAcknowledgmentXmlAction $mapper,
        protected SignXmlAction $signXml,
        protected StorageRepository $storage,
    ) {
        //
    }

    public function handle(InvoiceXml $invoiceXml, InvoiceResponse $invoiceReceived, ?string $certPath = null, ?string $certPassword = null): AcknowledgmentData
    {
        $xml = $this->mapper->handle($invoiceXml, $invoiceReceived);

        $signed = $this->signXml->handle($xml, $certPath, $certPassword);

        $object = new AcknowledgmentXml($signed);

        $path = $this->storage->save($signed, $object->getXmlName());

        return new AcknowledgmentData($object, $path);
    }
}
