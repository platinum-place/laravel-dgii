<?php

namespace PlatinumPlace\LaravelDgii\Data\CancellationRange;

/**
 * Data Transfer Object representing a stored Cancellation Range document in the file system.
 *
 * This class encapsulates the parsed XML, its file path, and the response received from DGII.
 */
readonly class CancellationRangeData
{
    /**
     * Create a new CancellationRangeData instance.
     *
     * @param  CancellationRangeXml  $xml  The parsed cancellation range XML object.
     * @param  string  $path  The absolute path where the XML file is stored.
     * @param  CancellationRangeResponse  $response  The response received from DGII after submission.
     */
    public function __construct(
        public CancellationRangeXml $xml,
        public string $path,
        public CancellationRangeResponse $response,
    ) {
        //
    }
}
