<?php

namespace PlatinumPlace\LaravelDgii\Data\CommercialApproval;

readonly class CommercialApprovalData
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public CommercialApprovalXml $xml,
        public string $path,
        public CommercialApprovalResponse $response,
    ) {
        //
    }
}
