<?php

namespace PlatinumPlace\LaravelDgii\Data\CommercialApproval;

/**
 * Data object for a stored Commercial Approval document in the file system.
 */
readonly class CommercialApprovalData
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public CommercialApprovalXml $xml,
        public string $path,
        public array $response,
    ) {
        //
    }
}
