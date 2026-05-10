<?php

namespace PlatinumPlace\LaravelDgii\Data\CancellationRange;

use PlatinumPlace\LaravelDgii\Data\AbstractXml;

/**
 * Represents a Sequence Range Cancellation XML document (ANECF).
 *
 * This class provides structured access to the header and details of canceled e-CF sequences.
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
        // Check if the total count exists in the XML header
        if (! empty($this->xml?->Encabezado?->CantidadeNCFAnulados)) {
            // Return the value as an integer
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
        // Check if the cancellation date exists in the XML header
        if (! empty($this->xml?->Encabezado?->FechaHoraAnulacioneNCF)) {
            // Return the value as a string
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

        // Check if there are any cancellation details in the XML
        if (! empty($this->xml?->DetalleAnulacion?->Anulacion)) {
            // Iterate through each cancellation record
            foreach ($this->xml?->DetalleAnulacion?->Anulacion as $anulacion) {
                $sequences = [];
                // Extract the range of sequences for this record
                if (! empty($anulacion->TablaRangoSecuenciasAnuladaseNCF?->Secuencias)) {
                    foreach ($anulacion->TablaRangoSecuenciasAnuladaseNCF?->Secuencias as $seq) {
                        $sequences[] = [
                            'SecuenciaeNCFDesde' => (string) $seq->SecuenciaeNCFDesde,
                            'SecuenciaeNCFHasta' => (string) $seq->SecuenciaeNCFHasta,
                        ];
                    }
                }

                // Build the detail entry
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
