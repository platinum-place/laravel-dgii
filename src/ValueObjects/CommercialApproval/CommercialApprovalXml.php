<?php

namespace PlatinumPlace\LaravelDgii\ValueObjects\CommercialApproval;

use PlatinumPlace\LaravelDgii\Abstracts\AbstractXml;

/**
 * Represents a Commercial Approval XML document (ARECF).
 */
class CommercialApprovalXml extends AbstractXml
{
    /**
     * Get the buyer's identification (RNC) involved in the approval.
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
     */
    public function getXmlName(): ?string
    {
        if (! empty($this->xml?->DetalleAprobacionComercial)) {
            return $this->getBuyerIdentification().$this->getSequenceNumber();
        }

        return null;
    }
}
