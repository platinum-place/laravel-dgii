<?php

namespace PlatinumPlace\LaravelDgii\Data\CancellationRange;

readonly class CancellationRangeData
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public CancellationRangeXml $xml,
        public string $path,
        public CancellationRangeResponse $response,
    ) {
        //
    }
}
