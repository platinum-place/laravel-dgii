<?php

namespace PlatinumPlace\LaravelDgii\Data\Invoice;

use PlatinumPlace\LaravelDgii\Data\AbstractXml;

readonly class InvoiceXml extends AbstractXml
{
    /**
     * Get the e-CF sequence number (eNCF).
     * Corresponds to <eNCF> in <IdDoc>.
     */
    public function getSequenceNumber(): ?string
    {
        $sequence = $this->xml->Encabezado?->IdDoc?->eNCF;

        return ! empty($sequence) ? (string) $sequence : null;
    }

    /**
     * Get the security code of the e-CF.
     * Corresponds to <CodigoSeguridadeCF> or the first 6 characters of the SignatureValue.
     */
    public function getSecurityCode(): ?string
    {
        $securityCode = $this->xml->Encabezado?->CodigoSeguridadeCF;

        if (! empty($securityCode)) {
            return (string) $securityCode;
        }

        $signatureValue = $this->xml->Signature?->SignatureValue;

        return ! empty($signatureValue) ? substr((string) $signatureValue, 0, 6) : null;
    }

    /**
     * Get the date and time when the document was signed.
     * Corresponds to <FechaHoraFirma>.
     */
    public function getSignatureDate(): ?string
    {
        $signatureDate = $this->xml->FechaHoraFirma;

        return ! empty($signatureDate) ? (string) $signatureDate : date('d-m-Y H:i:s');
    }

    /**
     * Get the e-CF type.
     * Corresponds to <TipoeCF> in <IdDoc>.
     */
    public function getInvoiceType(): ?string
    {
        $type = $this->xml->Encabezado?->IdDoc?->TipoeCF;

        return ! empty($type) ? (string) $type : null;
    }

    /**
     * Get the total amount of the invoice.
     * Corresponds to <MontoTotal> in <Totales>.
     */
    public function getTotalAmount(): ?string
    {
        $total = $this->xml->Encabezado?->Totales?->MontoTotal;

        return ! empty($total) ? (string) $total : null;
    }

    /**
     * Check if the document is a Electronic Consumer Invoice Summary (RFCE).
     */
    public function isRfce(): bool
    {
        $securityCode = $this->xml->Encabezado?->CodigoSeguridadeCF;

        return ! empty($securityCode);
    }

    /**
     * Check if the document is a consume invoice based on type and total amount rules.
     */
    public function isConsumeInvoice(): bool
    {
        $type = (int) $this->getInvoiceType();
        $total = (float) $this->getTotalAmount();

        $consumeType = (int) config('dgii.rules.consume_invoice_type');
        $consumeLimit = (float) config('dgii.rules.consume_invoice_limit');

        return $this->isRfce() || ($type === $consumeType && $total < $consumeLimit);
    }

    /**
     * Get the sender identification (RNC).
     * Corresponds to <RNCEmisor> in <Emisor>.
     */
    public function getSenderIdentification(): ?string
    {
        $identification = $this->xml->Encabezado?->Emisor->RNCEmisor;

        return ! empty($identification) ? (string) $identification : null;
    }

    /**
     * Get the document release date.
     * Corresponds to <FechaEmision> in <Emisor>.
     */
    public function getReleaseDate(): ?string
    {
        $releaseDate = $this->xml->Encabezado?->Emisor?->FechaEmision;

        return ! empty($releaseDate) ? (string) $releaseDate : null;
    }

    /**
     * Get the buyer identification (RNC or Foreigner ID).
     * Corresponds to <RNCComprador> or <IdentificadorExtranjero> in <Comprador>.
     */
    public function getBuyerIdentification(): ?string
    {
        $identification = $this->xml->Encabezado?->Comprador?->RNCComprador 
            ?? $this->xml->Encabezado?->Comprador?->IdentificadorExtranjero;

        return ! empty($identification) ? (string) $identification : null;
    }

    /**
     * Get the generated XML name based on sender identification and sequence.
     */
    public function getXmlName(): ?string
    {
        $header = $this->xml->Encabezado;

        return ! empty($header) ? $this->getSenderIdentification().$this->getSequenceNumber() : null;
    }

    /**
     * Get the due date for the sequence.
     * Corresponds to <FechaVencimientoSecuencia> in <IdDoc>.
     */
    public function getSequenceDueDate(): ?string
    {
        $dueDate = $this->xml->Encabezado?->IdDoc?->FechaVencimientoSecuencia;

        return ! empty($dueDate) ? (string) $dueDate : null;
    }

    /**
     * Get the modified e-NCF sequence number.
     * Corresponds to <eNCFModificado> in <IdDoc>.
     */
    public function getModifiedSequenceNumber(): ?string
    {
        $modifiedSequence = $this->xml->Encabezado?->IdDoc?->eNCFModificado;

        return ! empty($modifiedSequence) ? (string) $modifiedSequence : null;
    }

    /**
     * Get the modification code.
     * Corresponds to <CodigoModificacion> in <IdDoc>.
     */
    public function getModificationCode(): ?string
    {
        $modificationCode = $this->xml->Encabezado?->IdDoc?->CodigoModificacion;

        return ! empty($modificationCode) ? (string) $modificationCode : null;
    }

    /**
     * Get additional information/observations for the buyer.
     * Corresponds to <InformacionAdicionalComprador> in <Comprador>.
     */
    public function getObservations(): ?string
    {
        $observations = $this->xml->Encabezado?->Comprador?->InformacionAdicionalComprador;

        return ! empty($observations) ? (string) $observations : null;
    }

    /**
     * Get the invoice line items.
     * Corresponds to <DetallesItems>.
     */
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

    /**
     * Get the buyer corporate name.
     * Corresponds to <RazonSocialComprador> in <Comprador>.
     */
    public function getBuyerCorporateName(): ?string
    {
        $corporateName = $this->xml->Encabezado?->Comprador?->RazonSocialComprador;

        return ! empty($corporateName) ? (string) $corporateName : null;
    }

    /**
     * Get the buyer address.
     * Corresponds to <DireccionComprador> in <Comprador>.
     */
    public function getBuyerAddress(): ?string
    {
        $address = $this->xml->Encabezado?->Comprador?->DireccionComprador;

        return ! empty($address) ? (string) $address : null;
    }

    /**
     * Check if the buyer is a foreigner.
     */
    public function isBuyerForeigner(): bool
    {
        $foreignerId = $this->xml->Encabezado?->Comprador?->IdentificadorExtranjero;

        return ! empty($foreignerId);
    }

    /**
     * Get the sender corporate name.
     * Corresponds to <RazonSocialEmisor> in <Emisor>.
     */
    public function getSenderCorporateName(): ?string
    {
        $corporateName = $this->xml->Encabezado?->Emisor->RazonSocialEmisor;

        return ! empty($corporateName) ? (string) $corporateName : null;
    }

    /**
     * Get the sender address.
     * Corresponds to <DireccionEmisor> in <Emisor>.
     */
    public function getSenderAddress(): ?string
    {
        $address = $this->xml->Encabezado?->Emisor->DireccionEmisor;

        return ! empty($address) ? (string) $address : null;
    }

    /**
     * Get the total taxes (ITBIS).
     * Corresponds to <TotalITBIS> in <Totales>.
     */
    public function getTotalTaxes(): ?float
    {
        $totalTaxes = $this->xml->Encabezado?->Totales?->TotalITBIS;

        return ! empty($totalTaxes) ? (float) $totalTaxes : null;
    }

    /**
     * Get the total amount taxed.
     * Corresponds to <MontoGravadoTotal> in <Totales>.
     */
    public function getTotalAmountTaxed(): ?float
    {
        $totalTaxed = $this->xml->Encabezado?->Totales?->MontoGravadoTotal;

        return ! empty($totalTaxed) ? (float) $totalTaxed : null;
    }

    /**
     * Get the total exempt amount.
     * Corresponds to <MontoExento> in <Totales>.
     */
    public function getTotalExempt(): ?float
    {
        $exemptAmount = $this->xml->Encabezado?->Totales?->MontoExento;

        return ! empty($exemptAmount) ? (float) $exemptAmount : null;
    }
}
