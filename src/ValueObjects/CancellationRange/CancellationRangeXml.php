<?php

namespace PlatinumPlace\LaravelDgii\ValueObjects\CancellationRange;

use PlatinumPlace\LaravelDgii\Abstracts\AbstractXml;

class CancellationRangeXml extends AbstractXml
{
    /**
     * Obtener el total de secuencias anuladas.
     */
    public function getTotal(): ?int
    {
        if (! empty($this->xml?->Encabezado?->CantidadeNCFAnulados)) {
            return (int) $this->xml?->Encabezado?->CantidadeNCFAnulados;
        }

        return null;
    }

    /**
     * Obtener la fecha y hora de la anulación.
     */
    public function getDate(): ?string
    {
        if (! empty($this->xml?->Encabezado?->FechaHoraAnulacioneNCF)) {
            return (string) $this->xml?->Encabezado?->FechaHoraAnulacioneNCF;
        }

        return null;
    }

    /**
     * Obtener el listado detallado de secuencias por tipo de e-CF.
     */
    public function getDetails(): array
    {
        $details = [];

        if (! empty($this->xml?->DetalleAnulacion?->Anulacion)) {
            foreach ($this->xml?->DetalleAnulacion?->Anulacion as $anulacion) {
                $sequences = [];
                if (! empty($anulacion->TablaRangoSecuenciasAnuladaseNCF?->Secuencias)) {
                    foreach ($anulacion->TablaRangoSecuenciasAnuladaseNCF?->Secuencias as $seq) {
                        $sequences[] = [
                            'SecuenciaeNCFDesde' => (string) $seq->SecuenciaeNCFDesde,
                            'SecuenciaeNCFHasta' => (string) $seq->SecuenciaeNCFHasta,
                        ];
                    }
                }

                $details[] = [
                    'NoLinea' => (int) $anulacion->NoLinea,
                    'TipoeCF' => (string) $anulacion->TipoeCF,
                    'CantidadeNCFAnulados' => (int) $anulacion->CantidadeNCFAnulados,
                    'Secuencias' => $sequences,
                ];
            }
        }

        return $details;
    }
}
