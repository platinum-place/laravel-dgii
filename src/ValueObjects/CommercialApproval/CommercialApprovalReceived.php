<?php

namespace PlatinumPlace\LaravelDgii\ValueObjects\CommercialApproval;

/**
 * Represents the response received after sending a Commercial Approval (ARECF) to DGII.
 */
readonly class CommercialApprovalReceived
{
    /**
     * Create a new class instance.
     *
     * @param  StoredCommercialApproval  $storedCommercialApproval  The local stored commercial approval object.
     * @param  array  $response  The HTTP response data from DGII.
     */
    public function __construct(
        public StoredCommercialApproval $storedCommercialApproval,
        public array $response,
    ) {
        //
    }
}
