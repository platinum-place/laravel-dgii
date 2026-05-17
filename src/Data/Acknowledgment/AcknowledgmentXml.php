<?php

namespace PlatinumPlace\LaravelDgii\Data\Acknowledgment;

use PlatinumPlace\LaravelDgii\Data\AbstractXml;

readonly class AcknowledgmentXml extends AbstractXml
{
    public function getBuyerIdentification(): ?string
    {
        $identification = $this->xml?->DetalleAcusedeRecibo?->RNCComprador;

        return ! empty($identification) ? (string) $identification : null;
    }

    public function getSequenceNumber(): ?string
    {
        $sequence = $this->xml?->DetalleAcusedeRecibo?->eNCF;

        return ! empty($sequence) ? (string) $sequence : null;
    }

    public function getXmlName(): ?string
    {
        $header = $this->xml?->DetalleAcusedeRecibo;

        return ! empty($header) ? $this->getBuyerIdentification().$this->getSequenceNumber() : null;
    }
}
