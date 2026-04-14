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

    public function getXmlName(): ?string
    {
        if (!empty($this->xml?->DetalleAprobacionComercial)) {
            return $this->getBuyerIdentification() . $this->getSequenceNumber();
        }

        if (!empty($this->xml?->DetalleAcusedeRecibo)) {
            return $this->getBuyerIdentification() . $this->getSequenceNumber();
        }

        return null;
    }
}