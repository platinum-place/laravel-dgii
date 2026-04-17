<?php

namespace PlatinumPlace\LaravelDgii\ValueObjects\Acknowledgment;

use PlatinumPlace\LaravelDgii\Abstracts\AbstractXml;

class AcknowledgmentXml extends AbstractXml
{
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
