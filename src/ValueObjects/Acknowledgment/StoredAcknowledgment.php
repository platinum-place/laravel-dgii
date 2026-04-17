<?php

namespace PlatinumPlace\LaravelDgii\ValueObjects\Acknowledgment;

/**
 * Data object for a stored Acknowledgment document in the file system.
 */
readonly class StoredAcknowledgment
{
    /**
     * Create a new class instance.
     *
     * @param  AcknowledgmentXml  $acknowledgmentXml  The acknowledgment XML object.
     * @param  string  $acknowledgmentXmlPath  Path where the XML is stored.
     */
    public function __construct(
        public AcknowledgmentXml $acknowledgmentXml,
        public string $acknowledgmentXmlPath,
    ) {
        //
    }
}
