<?php

namespace PlatinumPlace\LaravelDgii\Data\CommercialApproval;

use PlatinumPlace\LaravelDgii\Data\AbstractXml;

readonly class CommercialApprovalXml extends AbstractXml
{
    /**
     * Get the buyer identification (RNC).
     * Corresponds to <RNCComprador> in <DetalleAprobacionComercial>.
     */
    public function getBuyerIdentification(): ?string
    {
        $identification = $this->xml?->DetalleAprobacionComercial?->RNCComprador;

        return ! empty($identification) ? (string) $identification : null;
    }

    /**
     * Get the e-CF sequence number (eNCF).
     * Corresponds to <eNCF> in <DetalleAprobacionComercial> or <DetalleAcusedeRecibo>.
     */
    public function getSequenceNumber(): ?string
    {
        $sequence = $this->xml?->DetalleAprobacionComercial?->eNCF 
            ?? $this->xml?->DetalleAcusedeRecibo?->eNCF;

        return ! empty($sequence) ? (string) $sequence : null;
    }

    /**
     * Get the generated XML name based on buyer identification and sequence.
     */
    public function getXmlName(): ?string
    {
        $header = $this->xml?->DetalleAprobacionComercial;

        return ! empty($header) ? $this->getBuyerIdentification().$this->getSequenceNumber() : null;
    }
}
