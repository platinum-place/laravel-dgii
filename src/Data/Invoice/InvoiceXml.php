<?php

namespace PlatinumPlace\LaravelDgii\Data\Invoice;

use PlatinumPlace\LaravelDgii\Data\AbstractXml;

readonly class InvoiceXml extends AbstractXml
{
    public function getSequenceNumber(): ?string
    {
        $sequence = $this->xml->Encabezado?->IdDoc?->eNCF;

        return ! empty($sequence) ? (string) $sequence : null;
    }

    public function getSecurityCode(): ?string
    {
        $securityCode = $this->xml->Encabezado?->CodigoSeguridadeCF;

        if (! empty($securityCode)) {
            return (string) $securityCode;
        }

        $signatureValue = $this->xml->Signature?->SignatureValue;

        return ! empty($signatureValue) ? substr((string) $signatureValue, 0, 6) : null;
    }

    public function getSignatureDate(): ?string
    {
        $signatureDate = $this->xml->FechaHoraFirma;

        return ! empty($signatureDate) ? (string) $signatureDate : date('d-m-Y H:i:s');
    }

    public function getInvoiceType(): ?string
    {
        $type = $this->xml->Encabezado?->IdDoc?->TipoeCF;

        return ! empty($type) ? (string) $type : null;
    }

    public function getTotalAmount(): ?string
    {
        $total = $this->xml->Encabezado?->Totales?->MontoTotal;

        return ! empty($total) ? (string) $total : null;
    }

    public function isConsumerInvoice(): bool
    {
        $type = (int) $this->getInvoiceType();
        $total = (float) $this->getTotalAmount();
        $securityCode = $this->xml->Encabezado?->CodigoSeguridadeCF;

        $consumeType = (int) config('dgii.rules.consumer_invoice_type');
        $consumeLimit = (float) config('dgii.rules.consumer_invoice_limit');

        return ! empty($securityCode) || ($type === $consumeType && $total < $consumeLimit);
    }

    public function getSenderIdentification(): ?string
    {
        $identification = $this->xml->Encabezado?->Emisor->RNCEmisor;

        return ! empty($identification) ? (string) $identification : null;
    }

    public function getReleaseDate(): ?string
    {
        $releaseDate = $this->xml->Encabezado?->Emisor?->FechaEmision;

        return ! empty($releaseDate) ? (string) $releaseDate : null;
    }

    public function getBuyerIdentification(): ?string
    {
        $identification = $this->xml->Encabezado?->Comprador?->RNCComprador
            ?? $this->xml->Encabezado?->Comprador?->IdentificadorExtranjero;

        return ! empty($identification) ? (string) $identification : null;
    }

    public function getXmlName(): ?string
    {
        $header = $this->xml->Encabezado;

        return ! empty($header) ? $this->getSenderIdentification().$this->getSequenceNumber() : null;
    }

    public function getSequenceDueDate(): ?string
    {
        $dueDate = $this->xml->Encabezado?->IdDoc?->FechaVencimientoSecuencia;

        return ! empty($dueDate) ? (string) $dueDate : null;
    }

    public function getModifiedSequenceNumber(): ?string
    {
        $modifiedSequence = $this->xml->Encabezado?->IdDoc?->eNCFModificado;

        return ! empty($modifiedSequence) ? (string) $modifiedSequence : null;
    }

    public function getModificationCode(): ?string
    {
        $modificationCode = $this->xml->Encabezado?->IdDoc?->CodigoModificacion;

        return ! empty($modificationCode) ? (string) $modificationCode : null;
    }

    public function getObservations(): ?string
    {
        $observations = $this->xml->Encabezado?->Comprador?->InformacionAdicionalComprador;

        return ! empty($observations) ? (string) $observations : null;
    }

    public function getLines(): array
    {
        $lines = [];
        $items = $this->xml->DetallesItems?->Item;

        if (empty($items)) {
            return $lines;
        }

        foreach ($items as $item) {
            $lines[] = [
                'NumeroLinea' => (int) $item->NumeroLinea,
                'NombreItem' => (string) $item->NombreItem,
                'CantidadItem' => (float) $item->CantidadItem,
                'PrecioUnitarioItem' => (float) $item->PrecioUnitarioItem,
                'DescuentoMonto' => (float) ($item->DescuentoMonto ?? 0),
                'MontoItem' => (float) $item->MontoItem,
                'MontoImpuesto' => (float) ($item->MontoImpuesto ?? 0),
            ];
        }

        return $lines;
    }

    public function getBuyerCorporateName(): ?string
    {
        $corporateName = $this->xml->Encabezado?->Comprador?->RazonSocialComprador;

        return ! empty($corporateName) ? (string) $corporateName : null;
    }

    public function getBuyerAddress(): ?string
    {
        $address = $this->xml->Encabezado?->Comprador?->DireccionComprador;

        return ! empty($address) ? (string) $address : null;
    }

    public function isBuyerForeigner(): bool
    {
        $foreignerId = $this->xml->Encabezado?->Comprador?->IdentificadorExtranjero;

        return ! empty($foreignerId);
    }

    public function getSenderCorporateName(): ?string
    {
        $corporateName = $this->xml->Encabezado?->Emisor->RazonSocialEmisor;

        return ! empty($corporateName) ? (string) $corporateName : null;
    }

    public function getSenderAddress(): ?string
    {
        $address = $this->xml->Encabezado?->Emisor->DireccionEmisor;

        return ! empty($address) ? (string) $address : null;
    }

    public function getTotalTaxes(): ?float
    {
        $totalTaxes = $this->xml->Encabezado?->Totales?->TotalITBIS;

        return ! empty($totalTaxes) ? (float) $totalTaxes : null;
    }

    public function getTotalAmountTaxed(): ?float
    {
        $totalTaxed = $this->xml->Encabezado?->Totales?->MontoGravadoTotal;

        return ! empty($totalTaxed) ? (float) $totalTaxed : null;
    }

    public function getTotalExempt(): ?float
    {
        $exemptAmount = $this->xml->Encabezado?->Totales?->MontoExento;

        return ! empty($exemptAmount) ? (float) $exemptAmount : null;
    }
}
