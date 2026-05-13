<?php

namespace PlatinumPlace\LaravelDgii\Data\CancellationRange;

use PlatinumPlace\LaravelDgii\Data\AbstractXml;

readonly class CancellationRangeXml extends AbstractXml
{
    /**
     * Get the total number of canceled e-NCFs.
     * Corresponds to <CantidadeNCFAnulados> in <Encabezado>.
     */
    public function getTotal(): ?int
    {
        $total = $this->xml?->Encabezado?->CantidadeNCFAnulados;

        return ! empty($total) ? (int) $total : null;
    }

    /**
     * Get the date and time of the cancellation.
     * Corresponds to <FechaHoraAnulacioneNCF> in <Encabezado>.
     */
    public function getDate(): ?string
    {
        $date = $this->xml?->Encabezado?->FechaHoraAnulacioneNCF;

        return ! empty($date) ? (string) $date : null;
    }

    /**
     * Get the cancellation details.
     * Corresponds to <DetalleAnulacion>.
     */
    public function getDetails(): array
    {
        $details = [];
        $items = $this->xml?->DetalleAnulacion?->Anulacion;

        if (empty($items)) {
            return $details;
        }

        foreach ($items as $item) {
            $sequences = [];
            $rawSequences = $item->TablaRangoSecuenciasAnuladaseNCF?->Secuencias;

            if (! empty($rawSequences)) {
                foreach ($rawSequences as $sequence) {
                    $sequences[] = [
                        'SecuenciaeNCFDesde' => (string) $sequence->SecuenciaeNCFDesde,
                        'SecuenciaeNCFHasta' => (string) $sequence->SecuenciaeNCFHasta,
                    ];
                }
            }

            $details[] = [
                'NoLinea' => (int) $item->NoLinea,
                'TipoeCF' => (string) $item->TipoeCF,
                'CantidadeNCFAnulados' => (int) $item->CantidadeNCFAnulados,
                'Secuencias' => $sequences,
            ];
        }

        return $details;
    }
}
