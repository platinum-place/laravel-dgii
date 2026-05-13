<?php

namespace PlatinumPlace\LaravelDgii\Data\Acknowledgment;

readonly class AcknowledgmentData
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public AcknowledgmentXml $xml,
        public string $path,
    ) {
        //
    }
}
