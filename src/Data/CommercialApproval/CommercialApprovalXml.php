<?php

namespace PlatinumPlace\LaravelDgii\Data\CommercialApproval;

use PlatinumPlace\LaravelDgii\Data\AbstractXml;

readonly class CommercialApprovalXml extends AbstractXml
{
    public function getBuyerIdentification(): ?string
    {
        $identification = $this->xml?->DetalleAprobacionComercial?->RNCComprador;

        return ! empty($identification) ? (string) $identification : null;
    }

    public function getSequenceNumber(): ?string
    {
        $sequence = $this->xml?->DetalleAprobacionComercial?->eNCF
            ?? $this->xml?->DetalleAcusedeRecibo?->eNCF;

        return ! empty($sequence) ? (string) $sequence : null;
    }

    public function getXmlName(): ?string
    {
        $header = $this->xml?->DetalleAprobacionComercial;

        return ! empty($header) ? $this->getBuyerIdentification().$this->getSequenceNumber() : null;
    }
}
