<?php

namespace PlatinumPlace\LaravelDgii\ValueObjects\Acknowledgment;

/**
 * Data object for a signed Acknowledgment document.
 */
class SignedAcknowledgment
{
    /**
     * Create a new class instance.
     *
     * @param  string  $content  Raw signed XML content.
     * @param  string  $path  Path where the signed XML is temporarily stored.
     */
    public function __construct(
        public string $content,
        public string $path,
    ) {
        //
    }
}
