<?php

namespace PlatinumPlace\LaravelDgii\Actions\Acknowledgment;

use PlatinumPlace\LaravelDgii\Support\StorageService;
use PlatinumPlace\LaravelDgii\ValueObjects\Acknowledgment\AcknowledgmentXml;
use PlatinumPlace\LaravelDgii\ValueObjects\Acknowledgment\StoredAcknowledgment;

/**
 * Action to persist an Acknowledgment (Acuse de Recibo) XML to storage.
 */
class StorageAcknowledgmentAction
{
    /**
     * Create a new class instance.
     *
     * @param StorageService $storageService Storage service instance.
     */
    public function __construct(protected StorageService $storageService)
    {
        //
    }

    /**
     * Store the signed Acknowledgment XML content.
     *
     * @param AcknowledgmentXml $acknowledgmentXml The acknowledgment XML object.
     * @return StoredAcknowledgment The stored acknowledgment data.
     */
    public function handle(AcknowledgmentXml $acknowledgmentXml): StoredAcknowledgment
    {
        $acknowledgmentXmlPath = $this->storageService->putXml($acknowledgmentXml->xmlContent, $acknowledgmentXml->getXmlName());

        return new StoredAcknowledgment($acknowledgmentXml, $acknowledgmentXmlPath);
    }
}
