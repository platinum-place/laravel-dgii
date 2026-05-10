<?php

namespace PlatinumPlace\LaravelDgii\Data\CancellationRange;

/**
 * Data object for a stored Cancellation Range document in the file system.
 */
readonly class CancellationRangeData
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public CancellationRangeXml $xml,
        public string $path,
        public CancellationRangeReceived $response,
    ) {
        //
    }
}
