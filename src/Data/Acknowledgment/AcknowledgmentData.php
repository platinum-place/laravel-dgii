<?php

namespace PlatinumPlace\LaravelDgii\Data\Acknowledgment;

/**
 * Data Transfer Object representing a stored Acknowledgment (Acuse de Recibo) document.
 *
 * This class holds the parsed XML object and its corresponding file path.
 */
readonly class AcknowledgmentData
{
    /**
     * Create a new AcknowledgmentData instance.
     *
     * @param  AcknowledgmentXml  $xml  The parsed acknowledgment XML object.
     * @param  string  $path  The absolute path where the XML file is stored.
     */
    public function __construct(
        public AcknowledgmentXml $xml,
        public string $path,
    ) {
        //
    }
}
