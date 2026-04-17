<?php

namespace PlatinumPlace\LaravelDgii\Actions\Acknowledgment;

use PlatinumPlace\LaravelDgii\Support\StorageService;
use PlatinumPlace\LaravelDgii\ValueObjects\Acknowledgment\AcknowledgmentXml;
use PlatinumPlace\LaravelDgii\ValueObjects\Acknowledgment\StoredAcknowledgment;

class StorageAcknowledgmentAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected StorageService $storageService)
    {
        //
    }

    public function handle(AcknowledgmentXml $acknowledgmentXml): StoredAcknowledgment
    {
        $acknowledgmentXmlPath = $this->storageService->putXml($acknowledgmentXml->xmlContent, $acknowledgmentXml->getXmlName());

        return new StoredAcknowledgment($acknowledgmentXml, $acknowledgmentXmlPath);
    }
}
