<?php

namespace PlatinumPlace\LaravelDgii\ValueObjects\CancellationRange;

readonly class StoredCancellationRange
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public CancellationRangeXml $cancellationRangeXml,
        public string $cancellationRangeXmlPath,
    ) {
        //
    }
}
