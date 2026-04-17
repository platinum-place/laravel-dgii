<?php

namespace PlatinumPlace\LaravelDgii\ValueObjects\CommercialApproval;

/**
 * Data object for a stored Commercial Approval document in the file system.
 */
readonly class StoredCommercialApproval
{
    /**
     * Create a new class instance.
     *
     * @param CommercialApprovalXml $commercialApprovalXml The commercial approval XML object.
     * @param string $commercialApprovalXmlPath Path where the XML is stored.
     */
    public function __construct(
        public CommercialApprovalXml $commercialApprovalXml,
        public string $commercialApprovalXmlPath,
    ) {
        //
    }
}
