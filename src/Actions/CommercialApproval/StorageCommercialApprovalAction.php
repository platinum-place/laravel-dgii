<?php

namespace PlatinumPlace\LaravelDgii\Actions\CommercialApproval;

use PlatinumPlace\LaravelDgii\Data\CommercialApproval\CommercialApprovalXml;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;

/**
 * Action to persist a Commercial Approval (ARECF) XML to storage.
 */
class StorageCommercialApprovalAction
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
     * Store the signed Commercial Approval XML content.
     *
     * @param  CommercialApprovalXml  $commercialApprovalXml  The commercial approval XML object.
     * @return string The relative path of the stored XML file.
     */
    public function handle(CommercialApprovalXml $commercialApprovalXml): string
    {
        return $this->storageService->save($commercialApprovalXml->xmlContent, $commercialApprovalXml->getXmlName());
    }
}
