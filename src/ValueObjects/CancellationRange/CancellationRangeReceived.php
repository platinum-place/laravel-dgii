<?php

namespace PlatinumPlace\LaravelDgii\ValueObjects\CancellationRange;

/**
 * Represents the response received after sending a Cancellation Range (ANECF) to DGII.
 */
readonly class CancellationRangeReceived
{
    /**
     * Create a new class instance.
     *
     * @param  StoredCancellationRange  $storedCancellationRange  The local stored cancellation range object.
     * @param  array  $response  The HTTP response data from DGII.
     */
    public function __construct(
        public StoredCancellationRange $storedCancellationRange,
        public array $response,
    ) {
        //
    }

    /**
     * Get the processing status from the DGII response.
     */
    public function getStatus(): ?string
    {
        return $this->response['nombre'] ?? null;
    }

    public function notReceived(): ?string
    {
        return empty($this->getStatus());
    }
}
