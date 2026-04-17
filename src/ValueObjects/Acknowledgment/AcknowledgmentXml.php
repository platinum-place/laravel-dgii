<?php

namespace PlatinumPlace\LaravelDgii\ValueObjects\Acknowledgment;

use PlatinumPlace\LaravelDgii\Abstracts\AbstractXml;

/**
 * Represents an Acknowledgment XML document (Acuse de Recibo).
 */
class AcknowledgmentXml extends AbstractXml
{
    /**
     * Get the buyer's identification (RNC) from the document.
     */
    public function getBuyerIdentification(): ?string
    {
        if (! empty($this->xmlSigner?->DetalleAcusedeRecibo?->RNCComprador)) {
            return (string) $this->xmlSigner?->DetalleAcusedeRecibo?->RNCComprador;
        }

        return null;
    }

    /**
     * Get the e-CF sequence number (eNCF) from the document.
     */
    public function getSequenceNumber(): ?string
    {
        if (! empty($this->xmlSigner?->DetalleAcusedeRecibo?->eNCF)) {
            return (string) $this->xmlSigner?->DetalleAcusedeRecibo?->eNCF;
        }

        return null;
    }

    /**
     * Get the suggested name for the XML file based on its content.
     */
    public function getXmlName(): ?string
    {
        if (! empty($this->xmlSigner?->DetalleAcusedeRecibo)) {
            return $this->getBuyerIdentification().$this->getSequenceNumber();
        }

        return null;
    }
}
