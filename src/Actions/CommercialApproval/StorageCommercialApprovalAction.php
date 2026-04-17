<?php

namespace PlatinumPlace\LaravelDgii\Actions\CommercialApproval;

use PlatinumPlace\LaravelDgii\Support\StorageService;
use PlatinumPlace\LaravelDgii\ValueObjects\CommercialApproval\CommercialApprovalXml;
use PlatinumPlace\LaravelDgii\ValueObjects\CommercialApproval\StoredCommercialApproval;

class StorageCommercialApprovalAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected StorageService $storageService)
    {
        //
    }

    public function handle(CommercialApprovalXml $commercialApprovalXml): StoredCommercialApproval
    {
        $commercialApprovalXmlPath = $this->storageService->putXml($commercialApprovalXml->xmlContent, $commercialApprovalXml->getXmlName());

        return new StoredCommercialApproval($commercialApprovalXml, $commercialApprovalXmlPath);
    }
}
