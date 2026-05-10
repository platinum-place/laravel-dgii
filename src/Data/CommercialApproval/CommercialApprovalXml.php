<?php

namespace PlatinumPlace\LaravelDgii\Data\CommercialApproval;

use PlatinumPlace\LaravelDgii\Data\AbstractXml;

/**
 * Represents a Commercial Approval XML document (ARECF).
 *
 * This class provides structured access to the approval/rejection details of an e-CF.
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
        // Check if the buyer RNC exists in the commercial approval details
        if (! empty($this->xml?->DetalleAprobacionComercial?->RNCComprador)) {
            // Return the value as a string
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
        // Try to extract from Commercial Approval detail
        if (! empty($this->xml?->DetalleAprobacionComercial?->eNCF)) {
            return (string) $this->xml?->DetalleAprobacionComercial?->eNCF;
        }

        // Fallback to Acknowledgment detail if available
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
        // Ensure the identification and sequence are available to build the name
        if (! empty($this->xml?->DetalleAprobacionComercial)) {
            // Combine buyer ID and sequence number
            return $this->getBuyerIdentification().$this->getSequenceNumber();
        }

        return null;
    }
}
