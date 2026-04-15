<?php

namespace PlatinumPlace\LaravelDgii\ValueObjects;

use SimpleXMLElement;

class CommercialApprovalXml
{
    protected SimpleXMLElement $xml;

    /**
     * Parsear un XML de aprobación comercial.
     *
     * @param string $xml Contenido XML plano.
     */
    public function __construct(string $xml)
    {
        $this->xml = simplexml_load_string($xml);
    }

    /**
     * Obtener el RNC del comprador involucrado en la aprobación.
     *
     * @return string|null
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
     *
     * @return string|null
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
     *
     * @return string|null
     */
    public function getXmlName(): ?string
    {
        if (! empty($this->xml?->DetalleAprobacionComercial)) {
            return $this->getBuyerIdentification().$this->getSequenceNumber();
        }

        return null;
    }
}
