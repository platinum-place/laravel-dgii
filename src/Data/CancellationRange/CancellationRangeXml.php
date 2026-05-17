<?php

namespace PlatinumPlace\LaravelDgii\Data\CancellationRange;

use PlatinumPlace\LaravelDgii\Data\AbstractXml;

readonly class CancellationRangeXml extends AbstractXml
{
    public function getTotal(): ?int
    {
        $total = $this->xml?->Encabezado?->CantidadeNCFAnulados;

        return ! empty($total) ? (int) $total : null;
    }

    public function getDate(): ?string
    {
        $date = $this->xml?->Encabezado?->FechaHoraAnulacioneNCF;

        return ! empty($date) ? (string) $date : null;
    }

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
