<?php

namespace PlatinumPlace\LaravelDgii\ValueObjects\Acknowledgment;

readonly class StoredAcknowledgment
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public AcknowledgmentXml $acknowledgmentXml,
        public string $acknowledgmentXmlPath,
    ) {
        //
    }
}
