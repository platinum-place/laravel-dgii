<?php

namespace PlatinumPlace\LaravelDgii\Actions\CommercialApproval;

use PlatinumPlace\LaravelDgii\Support\StorageService;
use PlatinumPlace\LaravelDgii\ValueObjects\CommercialApproval\CommercialApprovalXml;
use PlatinumPlace\LaravelDgii\ValueObjects\CommercialApproval\StoredCommercialApproval;

/**
 * Action to persist a Commercial Approval (ARECF) XML to storage.
 */
class StorageCommercialApprovalAction
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
     * Store the signed Commercial Approval XML content.
     *
     * @param CommercialApprovalXml $commercialApprovalXml The commercial approval XML object.
     * @return StoredCommercialApproval The stored commercial approval data.
     */
    public function handle(CommercialApprovalXml $commercialApprovalXml): StoredCommercialApproval
    {
        $commercialApprovalXmlPath = $this->storageService->putXml($commercialApprovalXml->xmlContent, $commercialApprovalXml->getXmlName());

        return new StoredCommercialApproval($commercialApprovalXml, $commercialApprovalXmlPath);
    }
}
