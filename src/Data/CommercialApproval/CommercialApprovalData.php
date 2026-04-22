<?php

namespace PlatinumPlace\LaravelDgii\Data\CommercialApproval;

/**
 * Data object for a stored Commercial Approval document in the file system.
 */
readonly class CommercialApprovalData
{
    /**
     * Create a new class instance.
     *
     * @param  CommercialApprovalXml  $commercialApprovalXml  The commercial approval XML object.
     * @param  string  $commercialApprovalXmlPath  The relative path where the XML is stored.
     * @param  array  $commercialApprovalReceived  The raw response received from DGII.
     */
    public function __construct(
        public CommercialApprovalXml $commercialApprovalXml,
        public string $commercialApprovalXmlPath,
        public array $commercialApprovalReceived,
    ) {
        //
    }
}
