<?php

namespace PlatinumPlace\LaravelDgii\ValueObjects\CommercialApproval;

use PlatinumPlace\LaravelDgii\Abstracts\AbstractXml;

class CommercialApprovalXml extends AbstractXml
{
    /**
     * Obtener el RNC del comprador involucrado en la aprobación.
     */
    public function getBuyerIdentification(): ?string
    {
        if (! empty($this->xml?->DetalleAprobacionComercial?->RNCComprador)) {
            return (string) $this->xml?->DetalleAprobacionComercial?->RNCComprador;
        }

        return null;
    }

    /**
     * Obtener el e-NCF del comprobante que se está aprobando o rechazando.
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
     * Generar un nombre sugerido para el archivo XML basado en RNC y secuencia.
     */
    public function getXmlName(): ?string
    {
        if (! empty($this->xml?->DetalleAprobacionComercial)) {
            return $this->getBuyerIdentification().$this->getSequenceNumber();
        }

        return null;
    }
}
