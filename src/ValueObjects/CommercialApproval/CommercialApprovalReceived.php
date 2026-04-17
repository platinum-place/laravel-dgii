<?php

namespace PlatinumPlace\LaravelDgii\ValueObjects\CommercialApproval;

use PlatinumPlace\LaravelDgii\Enums\ArecfStatusEnum;

readonly class CommercialApprovalReceived
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public StoredCommercialApproval $invoiceReceived,
        public array $response,
    ) {
        //
    }
}
