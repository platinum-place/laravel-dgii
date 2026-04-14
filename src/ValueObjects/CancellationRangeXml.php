<?php

namespace PlatinumPlace\LaravelDgii\ValueObjects;

use SimpleXMLElement;

class CancellationRangeXml
{
    protected SimpleXMLElement $xml;

    /**
     * Create a new class instance.
     */
    public function __construct(string $xml)
    {
        $this->xml = simplexml_load_string($xml);
    }

    public function getTotal(): ?int
    {
        if (!empty($this->xml?->Encabezado?->CantidadeNCFAnulados)) {
            return (int)$this->xml?->Encabezado?->CantidadeNCFAnulados;
        }

        return null;
    }

    public function getDate(): ?string
    {
        if (!empty($this->xml?->Encabezado?->FechaHoraAnulacioneNCF)) {
            return (string)$this->xml?->Encabezado?->FechaHoraAnulacioneNCF;
        }

        return null;
    }

    public function getDetails(): array
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
}