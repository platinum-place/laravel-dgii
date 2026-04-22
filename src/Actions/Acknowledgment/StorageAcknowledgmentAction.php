<?php

namespace PlatinumPlace\LaravelDgii\Actions\Acknowledgment;

use PlatinumPlace\LaravelDgii\Data\Acknowledgment\AcknowledgmentXml;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;

/**
 * Action to persist an Acknowledgment (Acuse de Recibo) XML to storage.
 */
class StorageAcknowledgmentAction
{
    /**
     * Create a new class instance.
     *
     * @param  StorageRepository  $storageService  Storage service instance.
     */
    public function __construct(protected StorageRepository $storageService)
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
        return $this->storageService->save($acknowledgmentXml->xmlContent, $acknowledgmentXml->getXmlName());
    }
}
