<?php

namespace PlatinumPlace\LaravelDgii\ValueObjects\CommercialApproval;

readonly class StoredCommercialApproval
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public CommercialApprovalXml $commercialApprovalXml,
        public string $commercialApprovalXmlPath,
    ) {
        //
    }
}
