<?php

namespace PlatinumPlace\LaravelDgii\Abstracts;

use AllowDynamicProperties;
use InvalidArgumentException;
use SimpleXMLElement;

#[AllowDynamicProperties]
abstract class AbstractXml
{
    protected SimpleXMLElement $xml;

    public string $xmlContent;

    /**
     * Create a new class instance.
     *
     * @throws InvalidArgumentException
     */
    public function __construct(string $xml)
    {
        $this->xmlContent = $xml;

        libxml_use_internal_errors(true);
        $loadedXml = simplexml_load_string($xml);

        if ($loadedXml === false) {
            $errors = libxml_get_errors();
            libxml_clear_errors();
            throw new InvalidArgumentException('El contenido XML no es válido: '.($errors[0]->message ?? 'Error desconocido'));
        }

        $this->xmlSigner = $loadedXml;
    }
}
