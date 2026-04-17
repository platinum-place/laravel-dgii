<?php

namespace PlatinumPlace\LaravelDgii\ValueObjects\CancellationRange;

use PlatinumPlace\LaravelDgii\Abstracts\AbstractXml;

/**
 * Represents a Sequence Range Cancellation XML document (ANECF).
 */
class CancellationRangeXml extends AbstractXml
{
    /**
     * Get the total number of canceled sequences.
     */
    public function getTotal(): ?int
    {
        if (! empty($this->xml?->Encabezado?->CantidadeNCFAnulados)) {
            return (int) $this->xml?->Encabezado?->CantidadeNCFAnulados;
        }

        return null;
    }

    /**
     * Get the date and time of the cancellation.
     */
    public function getDate(): ?string
    {
        if (! empty($this->xml?->Encabezado?->FechaHoraAnulacioneNCF)) {
            return (string) $this->xml?->Encabezado?->FechaHoraAnulacioneNCF;
        }

        return null;
    }

    /**
     * Get the detailed list of sequences by e-CF type.
     *
     * @return array List of cancellations grouped by line number.
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
