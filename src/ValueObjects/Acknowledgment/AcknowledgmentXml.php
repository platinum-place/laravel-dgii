<?php

namespace PlatinumPlace\LaravelDgii\ValueObjects\Acknowledgment;

use AllowDynamicProperties;
use SimpleXMLElement;

#[AllowDynamicProperties]
class AcknowledgmentXml
{
    protected SimpleXMLElement $xml;

    public string $xmlContent;

    /**
     * Create a new class instance.
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(string $xml)
    {
        $this->xmlContent = $xml;

        libxml_use_internal_errors(true);
        $loadedXml = simplexml_load_string($xml);

        if ($loadedXml === false) {
            $errors = libxml_get_errors();
            libxml_clear_errors();
            throw new \InvalidArgumentException('El contenido XML no es válido: '.($errors[0]->message ?? 'Error desconocido'));
        }

        $this->xmlSigner = $loadedXml;
    }

    public function getBuyerIdentification(): ?string
    {
        if (! empty($this->xmlSigner?->DetalleAcusedeRecibo?->RNCComprador)) {
            return (string) $this->xmlSigner?->DetalleAcusedeRecibo?->RNCComprador;
        }

        return null;
    }

    public function getSequenceNumber(): ?string
    {
        if (! empty($this->xmlSigner?->DetalleAcusedeRecibo?->eNCF)) {
            return (string) $this->xmlSigner?->DetalleAcusedeRecibo?->eNCF;
        }

        return null;
    }

    public function getXmlName(): ?string
    {
        if (! empty($this->xmlSigner?->DetalleAcusedeRecibo)) {
            return $this->getBuyerIdentification().$this->getSequenceNumber();
        }

        return null;
    }
}
