<?php

namespace PlatinumPlace\LaravelDgii\Data\CancellationRange;

use PlatinumPlace\LaravelDgii\Data\AbstractXml;

/**
 * Represents a Sequence Range Cancellation XML document (ANECF).
 */
readonly class CancellationRangeXml extends AbstractXml
{
    /**
     * Get the total number of canceled sequences from the header.
     *
     * @return int|null Total number of cancellations or null if not found.
     */
    public function getTotal(): ?int
    {
        if (! empty($this->xml?->Encabezado?->CantidadeNCFAnulados)) {
            return (int) $this->xml?->Encabezado?->CantidadeNCFAnulados;
        }

        return null;
    }

    /**
     * Get the date and time of the cancellation from the header.
     *
     * @return string|null ISO format date/time or null if not found.
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
