<?php

namespace PlatinumPlace\LaravelDgii\Actions\Acknowledgment;

use PlatinumPlace\LaravelDgii\Support\StorageService;
use PlatinumPlace\LaravelDgii\ValueObjects\Acknowledgment\AcknowledgmentXml;

/**
 * Action to persist an Acknowledgment (Acuse de Recibo) XML to storage.
 */
class StorageAcknowledgmentAction
{
    /**
     * Create a new class instance.
     *
     * @param  StorageService  $storageService  Storage service instance.
     */
    public function __construct(protected StorageService $storageService)
    {
        //
    }

    /**
     * Store the signed Acknowledgment XML content.
     *
     * @param  AcknowledgmentXml  $acknowledgmentXml  The signed acknowledgment XML object.
     * @return string The relative path of the stored XML file.
     */
    public function handle(AcknowledgmentXml $acknowledgmentXml): string
    {
        return $this->storageService->putXml($acknowledgmentXml->xmlContent, $acknowledgmentXml->getXmlName());
    }
}
