<?php

namespace PlatinumPlace\LaravelDgii\ValueObjects\CommercialApproval;

readonly class CommercialApprovalReceived
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public StoredCommercialApproval $storedCommercialApproval,
        public array $response,
    ) {
        //
    }
}
