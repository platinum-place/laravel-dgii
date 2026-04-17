<?php

namespace PlatinumPlace\LaravelDgii\ValueObjects\Acknowledgment;

class SignedAcknowledgment
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public string $content,
        public string $path,
    ) {
        //
    }
}
