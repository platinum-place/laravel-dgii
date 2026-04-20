<?php

namespace PlatinumPlace\LaravelDgii\Abstracts;

use AllowDynamicProperties;
use InvalidArgumentException;
use SimpleXMLElement;

/**
 * Base class for DGII XML documents.
 * Provides automatic validation and structured access to content.
 */
#[AllowDynamicProperties]
abstract class AbstractXml
{
    /** @var SimpleXMLElement The loaded XML root element for structured access. */
    protected SimpleXMLElement $xml;

    /** @var string The raw XML content as a string. */
    public string $xmlContent;

    /**
     * @var SimpleXMLElement Alias for the loaded XML root element (legacy/compatibility).
     */
    public SimpleXMLElement $xmlSigner;

    /**
     * Create a new class instance and validate XML content.
     *
     * Automatically parses the XML string into a SimpleXMLElement.
     *
     * @param  string  $xml  The raw XML content to process and validate.
     *
     * @throws InvalidArgumentException If the XML content is malformed or invalid.
     */
    public function __construct(string $xml)
    {
        $this->xmlContent = $xml;

        libxml_use_internal_errors(true);
        $loadedXml = simplexml_load_string($xml);

        if ($loadedXml === false) {
            $errors = libxml_get_errors();
            libxml_clear_errors();
            throw new InvalidArgumentException('The XML content is invalid: '.($errors[0]->message ?? 'Unknown error'));
        }

        $this->xmlSigner = $loadedXml;
        $this->xml = $loadedXml;
    }
}
