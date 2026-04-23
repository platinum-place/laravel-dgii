<?php

namespace PlatinumPlace\LaravelDgii\Data\CommercialApproval;

use PlatinumPlace\LaravelDgii\Data\AbstractXml;

/**
 * Represents a Commercial Approval XML document (ARECF).
 */
readonly class CommercialApprovalXml extends AbstractXml
{
    /**
     * Get the buyer's identification (RNC) involved in the approval from document content.
     *
     * @return string|null The buyer's identification number or null if not found.
     */
    public function getBuyerIdentification(): ?string
    {
        if (! empty($this->xml?->DetalleAprobacionComercial?->RNCComprador)) {
            return (string) $this->xml?->DetalleAprobacionComercial?->RNCComprador;
        }

        return null;
    }

    /**
     * Get the e-NCF of the receipt being approved or rejected.
     *
     * Supports both AprobacionComercial and AcusedeRecibo structures.
     *
     * @return string|null The e-CF sequence number or null if not found.
     */
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

    /**
     * Generate a suggested file name for the XML based on RNC and sequence.
     *
     * @return string|null The generated XML filename or null if required data is missing.
     */
    public function getXmlName(): ?string
    {
        if (! empty($this->xml?->DetalleAprobacionComercial)) {
            return $this->getBuyerIdentification().$this->getSequenceNumber();
        }

        return null;
    }
}
