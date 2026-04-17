<?php

namespace PlatinumPlace\LaravelDgii\ValueObjects\CancellationRange;

/**
 * Data object for a stored Cancellation Range document in the file system.
 */
readonly class StoredCancellationRange
{
    /**
     * Create a new class instance.
     *
     * @param CancellationRangeXml $cancellationRangeXml The cancellation range XML object.
     * @param string $cancellationRangeXmlPath Path where the XML is stored.
     */
    public function __construct(
        public CancellationRangeXml $cancellationRangeXml,
        public string $cancellationRangeXmlPath,
    ) {
        //
    }
}
