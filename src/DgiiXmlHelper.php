<?php

namespace PlatinumPlace\LaravelDgii;

use SimpleXMLElement;

class DgiiXmlHelper
{
    protected SimpleXMLElement $xml;

    /**
     * Create a new class instance.
     */
    public function __construct(string $xml)
    {
        $this->xml = simplexml_load_string($xml);
    }

    public function getSequenceNumber(): ?string
    {
        if (!empty($this->xml?->DetalleAcusedeRecibo?->eNCF)) {
            return (string)$this->xml?->DetalleAcusedeRecibo?->eNCF;
        }

        return null;
    }

    public function getArecfStatus(): ?string
    {
        if (!empty($this->xml?->DetalleAcusedeRecibo?->Estado)) {
            return (string)$this->xml?->DetalleAcusedeRecibo?->Estado;
        }

        return null;
    }

    public function getArecfCode(): ?string
    {
        if (!empty($this->xml?->DetalleAcusedeRecibo?->CodigoMotivoNoRecibido)) {
            return (string)$this->xml?->DetalleAcusedeRecibo?->CodigoMotivoNoRecibido;
        }

        return null;
    }

    public function isAcecf(): bool
    {
        return !empty($this->xml?->DetalleAprobacionComercial);
    }

    public function isArecf(): bool
    {
        return !empty($this->xml?->DetalleAcusedeRecibo);
    }

    public function getXmlName(): ?string
    {


        if (!empty($this->xml?->DetalleAcusedeRecibo)) {
            return $this->getBuyerIdentification() . $this->getSequenceNumber();
        }

        return null;
    }

    public function getBuyerIdentification(): ?string
    {
        if (!empty($this->xml?->DetalleAcusedeRecibo?->RNCComprador)) {
            return (string)$this->xml?->DetalleAcusedeRecibo?->RNCComprador;
        }

        return null;
    }











    public function getCancellationTotal(): ?int
    {
        if (!empty($this->xml?->Encabezado?->CantidadeNCFAnulados)) {
            return (int)$this->xml?->Encabezado?->CantidadeNCFAnulados;
        }

        return null;
    }

    public function getCancellationDate(): ?string
    {
        if (!empty($this->xml?->Encabezado?->FechaHoraAnulacioneNCF)) {
            return (string)$this->xml?->Encabezado?->FechaHoraAnulacioneNCF;
        }

        return null;
    }

    public function getCancellationDetails(): array
    {
        $details = [];

        if (!empty($this->xml?->DetalleAnulacion?->Anulacion)) {
            foreach ($this->xml?->DetalleAnulacion?->Anulacion as $anulacion) {
                $sequences = [];
                if (!empty($anulacion->TablaRangoSecuenciasAnuladaseNCF?->Secuencias)) {
                    foreach ($anulacion->TablaRangoSecuenciasAnuladaseNCF?->Secuencias as $seq) {
                        $sequences[] = [
                            'SecuenciaeNCFDesde' => (string)$seq->SecuenciaeNCFDesde,
                            'SecuenciaeNCFHasta' => (string)$seq->SecuenciaeNCFHasta,
                        ];
                    }
                }

                $details[] = [
                    'NoLinea' => (int)$anulacion->NoLinea,
                    'TipoeCF' => (string)$anulacion->TipoeCF,
                    'CantidadeNCFAnulados' => (int)$anulacion->CantidadeNCFAnulados,
                    'Secuencias' => $sequences,
                ];
            }
        }

        return $details;
    }

    public function withoutSignature(): ?string
    {
        $xml = $this->xml;

        $xml->registerXPathNamespace('ds', 'http://www.w3.org/2000/09/xmldsig#');

        foreach ($xml->xpath('//ds:Signature') as $signature) {
            unset($signature[0]);
        }

        return $xml->asXML();
    }
}
