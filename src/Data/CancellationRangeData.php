<?php

namespace PlatinumPlace\LaravelDgii\Data;

use PlatinumPlace\LaravelDgii\ValueObjects\CancellationRange\CancellationRangeReceived;
use PlatinumPlace\LaravelDgii\ValueObjects\CancellationRange\CancellationRangeXml;

/**
 * Data object for a stored Cancellation Range document in the file system.
 */
readonly class CancellationRangeData
{
    /**
     * Create a new class instance.
     *
     * @param  CancellationRangeXml  $cancellationRangeXml  The sequence range cancellation XML object.
     * @param  string  $cancellationRangeXmlPath  The relative path where the XML is stored.
     * @param  CancellationRangeReceived  $cancellationRangeReceived  The response data received from DGII.
     */
    public function __construct(
        public CancellationRangeXml $cancellationRangeXml,
        public string $cancellationRangeXmlPath,
        public CancellationRangeReceived $cancellationRangeReceived,
    ) {
        //
    }
}
