<?php

namespace PlatinumPlace\LaravelDgii\Data\Acknowledgment;

use PlatinumPlace\LaravelDgii\Data\AbstractXml;

/**
 * Represents an Acknowledgment XML document (Acuse de Recibo).
 */
readonly class AcknowledgmentXml extends AbstractXml
{
    /**
     * Get the buyer's identification (RNC) from the document content.
     *
     * @return string|null The buyer's identification number or null if not found.
     */
    public function getBuyerIdentification(): ?string
    {
        // Check if the buyer RNC exists in the acknowledgment details
        if (! empty($this->xmlSigner?->DetalleAcusedeRecibo?->RNCComprador)) {
            // Return the value as a string
            return (string) $this->xmlSigner?->DetalleAcusedeRecibo?->RNCComprador;
        }

        return null;
    }

    /**
     * Get the e-CF sequence number (eNCF) from the document content.
     *
     * @return string|null The e-CF sequence number or null if not found.
     */
    public function getSequenceNumber(): ?string
    {
        // Check if the sequence number exists in the acknowledgment details
        if (! empty($this->xmlSigner?->DetalleAcusedeRecibo?->eNCF)) {
            // Return the value as a string
            return (string) $this->xmlSigner?->DetalleAcusedeRecibo?->eNCF;
        }

        return null;
    }

    /**
     * Get the suggested name for the XML file based on its content.
     *
     * Combines buyer RNC and e-CF sequence number.
     *
     * @return string|null The generated XML filename or null if required data is missing.
     */
    public function getXmlName(): ?string
    {
        // Check if the detail section exists to build the name
        if (! empty($this->xmlSigner?->DetalleAcusedeRecibo)) {
            // Combine identification and sequence number
            return $this->getBuyerIdentification().$this->getSequenceNumber();
        }

        return null;
    }
}
