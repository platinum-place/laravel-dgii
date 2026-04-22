<?php

namespace PlatinumPlace\LaravelDgii\Data\Invoice;

use PlatinumPlace\LaravelDgii\Data\AbstractXml;

/**
 * Represents an Electronic Fiscal Receipt XML document (e-CF).
 */
readonly class InvoiceXml extends AbstractXml
{
    /**
     * Return the XML content without the digital signature block.
     *
     * Useful for auditing, canonicalization, or pre-processing tasks.
     *
     * @return string|null The XML string without the <ds:Signature> tag.
     */
    public function withoutSignature(): ?string
    {
        $xml = clone $this->xml;

        $xml->registerXPathNamespace('ds', 'http://www.w3.org/2000/09/xmldsig#');

        foreach ($xml->xpath('//ds:Signature') as $signature) {
            unset($signature[0]);
        }

        return $xml->asXML();
    }

    /**
     * Get the e-NCF (Electronic Fiscal Receipt Sequence Number).
     *
     * @return string|null The e-NCF sequence or null if not found.
     */
    public function getSequenceNumber(): ?string
    {
        if (! empty($this->xml->Encabezado?->IdDoc)) {
            return (string) $this->xml->Encabezado?->IdDoc?->eNCF;
        }

        return null;
    }

    /**
     * Get the 6-digit security code for the e-CF.
     *
     * For RFCE, it's explicitly defined; for standard e-CF, it's derived from the signature.
     *
     * @return string|null The 6-digit security code.
     */
    public function getSecurityCode(): ?string
    {
        if (! empty($this->xml->Encabezado?->CodigoSeguridadeCF)) {
            return (string) $this->xml->Encabezado?->CodigoSeguridadeCF;
        }

        if (! empty($this->xml->Signature?->SignatureValue)) {
            return substr((string) $this->xml->Signature?->SignatureValue, 0, 6);
        }

        return null;
    }

    /**
     * Get the digital signature date and time from the document.
     *
     * @return string|null ISO format date/time or null.
     */
    public function getSignatureDate(): ?string
    {
        if (! empty($this->xml->FechaHoraFirma)) {
            return (string) $this->xml->FechaHoraFirma;
        }

        return null;
    }

    /**
     * Get the invoice type code (e.g., 31, 32, 33, 41).
     *
     * @return string|null The e-CF type code.
     */
    public function getInvoiceType(): ?string
    {
        if (! empty($this->xml->Encabezado?->IdDoc?->TipoeCF)) {
            return (string) $this->xml->Encabezado?->IdDoc?->TipoeCF;
        }

        return null;
    }

    /**
     * Get the total amount of the document.
     *
     * @return string|null The total amount as a string.
     */
    public function getTotalAmount(): ?string
    {
        if (! empty($this->xml->Encabezado?->Totales?->MontoTotal)) {
            return (string) $this->xml->Encabezado?->Totales?->MontoTotal;
        }

        return null;
    }

    /**
     * Determine if the XML is an RFCE (Consolidated Consumption Summary).
     *
     * @return bool True if it is an RFCE.
     */
    public function isRfce(): bool
    {
        return ! empty($this->xml->Encabezado?->CodigoSeguridadeCF);
    }

    /**
     * Determine if it's a consumption invoice (B32) based on type and threshold rules.
     *
     * @return bool True if it's considered a consumption invoice.
     */
    public function isConsumeInvoice(): bool
    {
        $type = (int) $this->getInvoiceType();
        $total = (float) $this->getTotalAmount();

        return
            $this->isRfce() ||
            ($type === (int) config('dgii.rules.fc_type', 32) && $total < (float) config('dgii.rules.fc_limit', 250000));
    }

    /**
     * Get the sender's identification (RNC).
     *
     * @return string|null The sender's RNC.
     */
    public function getSenderIdentification(): ?string
    {
        if (! empty($this->xml->Encabezado?->Emisor->RNCEmisor)) {
            return (string) $this->xml->Encabezado?->Emisor->RNCEmisor;
        }

        return null;
    }

    /**
     * Get the document emission date.
     *
     * @return string|null The emission date string.
     */
    public function getReleaseDate(): ?string
    {
        if (! empty($this->xml->Encabezado?->Emisor?->FechaEmision)) {
            return (string) $this->xml->Encabezado?->Emisor?->FechaEmision;
        }

        return null;
    }

    /**
     * Get the buyer's identification (RNC or Foreign ID).
     *
     * @return string|null The buyer's ID or null if anonymous/missing.
     */
    public function getBuyerIdentification(): ?string
    {
        if (! empty($this->xml->Encabezado?->Comprador?->IdentificadorExtranjero)) {
            return (string) $this->xml->Encabezado?->Comprador?->IdentificadorExtranjero;
        }

        if (! empty($this->xml->Encabezado?->Comprador?->RNCComprador)) {
            return (string) $this->xml->Encabezado?->Comprador?->RNCComprador;
        }

        return null;
    }

    /**
     * Get a suggested file name for the XML based on sender and sequence.
     *
     * @return string|null The generated filename.
     */
    public function getXmlName(): ?string
    {
        if (! empty($this->xml->Encabezado)) {
            return $this->getSenderIdentification().$this->getSequenceNumber();
        }

        return null;
    }

    /**
     * Get the sequence expiration date.
     *
     * @return string|null The expiration date string.
     */
    public function getSequenceDueDate(): ?string
    {
        if (! empty($this->xml->Encabezado?->IdDoc?->FechaVencimientoSecuencia)) {
            return (string) $this->xml->Encabezado?->IdDoc?->FechaVencimientoSecuencia;
        }

        return null;
    }

    /**
     * Get the modified e-NCF (referenced in Credit/Debit Notes).
     *
     * @return string|null The original e-NCF sequence number.
     */
    public function getModifiedSequenceNumber(): ?string
    {
        if (! empty($this->xml->Encabezado?->IdDoc?->eNCFModificado)) {
            return (string) $this->xml->Encabezado?->IdDoc?->eNCFModificado;
        }

        return null;
    }

    /**
     * Get the modification Reason code for notes.
     *
     * @return string|null The modification code.
     */
    public function getModificationCode(): ?string
    {
        if (! empty($this->xml->Encabezado?->IdDoc?->CodigoModificacion)) {
            return (string) $this->xml->Encabezado?->IdDoc?->CodigoModificacion;
        }

        return null;
    }

    /**
     * Get additional information about the buyer if present.
     *
     * @return string|null Additional info or null.
     */
    public function getObservations(): ?string
    {
        if (! empty($this->xml->Encabezado?->Comprador?->InformacionAdicionalComprador)) {
            return (string) $this->xml->Encabezado?->Comprador?->InformacionAdicionalComprador;
        }

        return null;
    }

    /**
     * Get all invoice line items from the document.
     *
     * @return array List of items with their quantities, prices, and totals.
     */
    public function getLines(): array
    {
        $lines = [];

        if (! empty($this->xml->DetallesItems?->Item)) {
            foreach ($this->xml->DetallesItems?->Item as $item) {
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
        }

        return $lines;
    }

    /**
     * Get the buyer's corporate name (Razon Social).
     *
     * @return string|null The corporate name or null.
     */
    public function getBuyerCorporateName(): ?string
    {
        if (! empty($this->xml->Encabezado?->Comprador?->RazonSocialComprador)) {
            return (string) $this->xml->Encabezado?->Comprador?->RazonSocialComprador;
        }

        return null;
    }

    /**
     * Get the buyer's physical address.
     *
     * @return string|null The address string or null.
     */
    public function getBuyerAddress(): ?string
    {
        if (! empty($this->xml->Encabezado?->Comprador?->DireccionComprador)) {
            return (string) $this->xml->Encabezado?->Comprador?->DireccionComprador;
        }

        return null;
    }

    /**
     * Check if the buyer is identified as a foreigner.
     *
     * @return bool True if buyer has a foreign identifier.
     */
    public function isBuyerForeigner(): bool
    {
        return ! empty($this->xml->Encabezado?->Comprador?->IdentificadorExtranjero);
    }

    /**
     * Get the sender's corporate name (Razón Social).
     *
     * @return string|null The corporate name or null.
     */
    public function getSenderCorporateName(): ?string
    {
        if (! empty($this->xml->Encabezado?->Emisor->RazonSocialEmisor)) {
            return (string) $this->xml->Encabezado?->Emisor->RazonSocialEmisor;
        }

        return null;
    }

    /**
     * Get the sender's physical address.
     *
     * @return string|null The address string or null.
     */
    public function getSenderAddress(): ?string
    {
        if (! empty($this->xml->Encabezado?->Emisor->DireccionEmisor)) {
            return (string) $this->xml->Encabezado?->Emisor->DireccionEmisor;
        }

        return null;
    }

    /**
     * Get the total ITBIS (VAT) amount.
     *
     * @return float|null Total taxes or null.
     */
    public function getTotalTaxes(): ?float
    {
        if (! empty($this->xml->Encabezado?->Totales?->TotalITBIS)) {
            return (float) $this->xml->Encabezado?->Totales?->TotalITBIS;
        }

        return null;
    }

    /**
     * Get the total amount subject to taxes (Monto Gravado).
     *
     * @return float|null Total taxed amount or null.
     */
    public function getTotalAmountTaxed(): ?float
    {
        if (! empty($this->xml->Encabezado?->Totales?->MontoGravadoTotal)) {
            return (float) $this->xml->Encabezado?->Totales?->MontoGravadoTotal;
        }

        return null;
    }

    /**
     * Get the total exempt amount.
     *
     * @return float|null Total exempt amount or null.
     */
    public function getTotalExempt(): ?float
    {
        if (! empty($this->xml->Encabezado?->Totales?->MontoExento)) {
            return (float) $this->xml->Encabezado?->Totales?->MontoExento;
        }

        return null;
    }
}
