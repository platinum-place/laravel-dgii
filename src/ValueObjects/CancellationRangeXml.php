<?php

namespace PlatinumPlace\LaravelDgii\ValueObjects;

use SimpleXMLElement;

class CancellationRangeXml
{
    protected SimpleXMLElement $xml;

    /**
     * Create a new class instance.
     */
    public function __construct(string $xml)
    {
        $this->xml = simplexml_load_string($xml);
    }
}