<?php

namespace PlatinumPlace\LaravelDgii\ValueObjects\CancellationRange;

use PlatinumPlace\LaravelDgii\Data\CancellationRangeData;

/**
 * Represents the response received after sending a Cancellation Range (ANECF) to DGII.
 */
readonly class CancellationRangeReceived
{
    /**
     * Create a new class instance.
     *
     * @param array $response The HTTP response data from DGII.
     */
    public function __construct(
        public array $response,
    )
    {
        //
    }

    /**
     * Get the processing status from the DGII response.
     *
     * @return string|null The status name or null if not found.
     */
    public function getStatus(): ?string
    {
        return $this->response['nombre'] ?? null;
    }

    /**
     * Check if the document was not successfully received by DGII.
     *
     * @return bool True if the document was not received.
     */
    public function notReceived(): bool
    {
        return empty($this->getStatus());
    }
}
