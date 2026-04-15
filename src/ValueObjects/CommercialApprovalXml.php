<?php

namespace PlatinumPlace\LaravelDgii\ValueObjects;

use SimpleXMLElement;

class CommercialApprovalXml
{
    protected SimpleXMLElement $xml;

    /**
     * Create a new class instance.
     */
    public function __construct(string $xml)
    {
        $this->xml = simplexml_load_string($xml);
    }

    public function getBuyerIdentification(): ?string
    {
        if (! empty($this->xml?->DetalleAprobacionComercial?->RNCComprador)) {
            return (string) $this->xml?->DetalleAprobacionComercial?->RNCComprador;
        }

        return null;
    }

    public function getSequenceNumber(): ?string
    {
        if (! empty($this->xml?->DetalleAprobacionComercial?->eNCF)) {
            return (string) $this->xml?->DetalleAprobacionComercial?->eNCF;
        }

        if (! empty($this->xml?->DetalleAcusedeRecibo?->eNCF)) {
            return (string) $this->xml?->DetalleAcusedeRecibo?->eNCF;
        }

        return null;
    }

    public function getXmlName(): ?string
    {
        if (! empty($this->xml?->DetalleAprobacionComercial)) {
            return $this->getBuyerIdentification().$this->getSequenceNumber();
        }

        return null;
    }
}
