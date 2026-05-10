<?php

namespace PlatinumPlace\LaravelDgii\Data\CancellationRange;

/**
 * Represents the response received after sending a Cancellation Range (ANECF) to DGII.
 *
 * This class wraps the raw response array to provide structured access to status and processing results.
 */
readonly class CancellationRangeReceived
{
    /**
     * Create a new CancellationRangeReceived instance.
     *
     * @param  array  $response  The raw HTTP response data from DGII.
     */
    public function __construct(
        public array $response,
    ) {
        //
    }

    /**
     * Get the processing status from the DGII response.
     *
     * @return string|null The status name or null if not found.
     */
    public function getStatus(): ?string
    {
        // Extract the 'nombre' field which typically contains the status
        return $this->response['nombre'] ?? null;
    }

    /**
     * Check if the document was not successfully received by DGII.
     *
     * @return bool True if the document was not received.
     */
    public function notReceived(): bool
    {
        // If status is empty, it means the document was not properly received or processed
        return empty($this->getStatus());
    }
}
