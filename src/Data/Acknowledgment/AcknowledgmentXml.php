<?php

namespace PlatinumPlace\LaravelDgii\Data\Acknowledgment;

use PlatinumPlace\LaravelDgii\Data\AbstractXml;

readonly class AcknowledgmentXml extends AbstractXml
{
    /**
     * Get the buyer identification (RNC).
     * Corresponds to <RNCComprador> in <DetalleAcusedeRecibo>.
     */
    public function getBuyerIdentification(): ?string
    {
        $identification = $this->xml?->DetalleAcusedeRecibo?->RNCComprador;

        return ! empty($identification) ? (string) $identification : null;
    }

    /**
     * Get the e-CF sequence number (eNCF).
     * Corresponds to <eNCF> in <DetalleAcusedeRecibo>.
     */
    public function getSequenceNumber(): ?string
    {
        $sequence = $this->xml?->DetalleAcusedeRecibo?->eNCF;

        return ! empty($sequence) ? (string) $sequence : null;
    }

    /**
     * Get the generated XML name based on buyer identification and sequence.
     */
    public function getXmlName(): ?string
    {
        $header = $this->xml?->DetalleAcusedeRecibo;

        return ! empty($header) ? $this->getBuyerIdentification().$this->getSequenceNumber() : null;
    }
}
