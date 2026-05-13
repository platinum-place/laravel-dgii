<?php

namespace PlatinumPlace\LaravelDgii\Data;

use InvalidArgumentException;
use SimpleXMLElement;

abstract readonly class AbstractXml
{
    protected SimpleXMLElement $xml;

    public string $content;

    /**
     * Create a new class instance.
     */
    public function __construct(string $xml)
    {
        $this->content = $xml;

        libxml_use_internal_errors(true);
        $loadedXml = simplexml_load_string($xml);

        if ($loadedXml === false) {
            $errors = libxml_get_errors();
            libxml_clear_errors();
            throw new InvalidArgumentException('Formato inválido: '.($errors[0]->message ?? 'Error desconocido.'));
        }

        $this->xml = $loadedXml;
    }

    public function withoutSignature(): ?string
    {
        $xml = clone $this->xml;

        $xml->registerXPathNamespace('ds', 'http://www.w3.org/2000/09/xmldsig#');

        foreach ($xml->xpath('//ds:Signature') as $signature) {
            unset($signature[0]);
        }

        return $xml->asXML();
    }
}
