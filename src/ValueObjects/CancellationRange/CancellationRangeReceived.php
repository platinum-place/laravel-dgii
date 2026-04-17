<?php

namespace PlatinumPlace\LaravelDgii\ValueObjects\CancellationRange;

readonly class CancellationRangeReceived
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public StoredCancellationRange $storedCancellationRange,
        public array $response,
    ) {
        //
    }
}
