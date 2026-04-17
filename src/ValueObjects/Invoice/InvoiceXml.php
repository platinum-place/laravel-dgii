<?php

namespace PlatinumPlace\LaravelDgii\ValueObjects\Invoice;

use PlatinumPlace\LaravelDgii\Abstracts\AbstractXml;

/**
 * Represents an Electronic Fiscal Receipt XML document (e-CF).
 */
class InvoiceXml extends AbstractXml
{
    /**
     * Return the XML without the digital signature (useful for auditing or pre-processing).
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
     */
    public function getSequenceNumber(): ?string
    {
        if (! empty($this->xml?->Encabezado?->IdDoc)) {
            return (string) $this->xml?->Encabezado?->IdDoc?->eNCF;
        }

        return null;
    }

    /**
     * Get the 6-digit security code for the e-CF.
     */
    public function getSecurityCode(): ?string
    {
        if (! empty($this->xml?->Encabezado?->CodigoSeguridadeCF)) {
            return (string) $this->xml?->Encabezado?->CodigoSeguridadeCF;
        }

        if (! empty($this->xml?->Signature?->SignatureValue)) {
            return substr((string) $this->xml?->Signature?->SignatureValue, 0, 6);
        }

        return null;
    }

    /**
     * Get the digital signature date and time.
     */
    public function getSignatureDate(): ?string
    {
        if (! empty($this->xml?->FechaHoraFirma)) {
            return (string) $this->xml?->FechaHoraFirma;
        }

        return null;
    }

    /**
     * Get the invoice type code (e.g., 31, 32, 33, 41).
     */
    public function getInvoiceType(): ?string
    {
        if (! empty($this->xml?->Encabezado?->IdDoc?->TipoeCF)) {
            return (string) $this->xml?->Encabezado?->IdDoc?->TipoeCF;
        }

        return null;
    }

    /**
     * Get the total amount of the document.
     */
    public function getTotalAmount(): ?string
    {
        if (! empty($this->xml?->Encabezado?->Totales?->MontoTotal)) {
            return (string) $this->xml?->Encabezado?->Totales?->MontoTotal;
        }

        return null;
    }

    /**
     * Determine if the XML is an RFCE (Consolidated Consumption Summary).
     */
    public function isRfce(): bool
    {
        return ! empty($this->xml?->Encabezado?->CodigoSeguridadeCF);
    }

    /**
     * Determine if it's a consumption invoice (B32) based on type and threshold.
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
     */
    public function getSenderIdentification(): ?string
    {
        if (! empty($this->xml?->Encabezado?->Emisor->RNCEmisor)) {
            return (string) $this->xml?->Encabezado?->Emisor->RNCEmisor;
        }

        return null;
    }

    /**
     * Get the document release date.
     */
    public function getReleaseDate(): ?string
    {
        if (! empty($this->xml?->Encabezado?->Emisor?->FechaEmision)) {
            return (string) $this->xml?->Encabezado?->Emisor?->FechaEmision;
        }

        return null;
    }

    /**
     * Get the buyer's identification (RNC or Foreign ID).
     */
    public function getBuyerIdentification(): ?string
    {
        if (! empty($this->xml?->Encabezado?->Comprador?->IdentificadorExtranjero)) {
            return (string) $this->xml?->Encabezado?->Comprador?->IdentificadorExtranjero;
        }

        if (! empty($this->xml?->Encabezado?->Comprador?->RNCComprador)) {
            return (string) $this->xml?->Encabezado?->Comprador?->RNCComprador;
        }

        return null;
    }

    /**
     * Get a suggested file name for the XML.
     */
    public function getXmlName(): ?string
    {
        if (! empty($this->xml?->Encabezado)) {
            return $this->getSenderIdentification().$this->getSequenceNumber();
        }

        return null;
    }

    /**
     * Get the sequence expiration date.
     */
    public function getSequenceDueDate(): ?string
    {
        if (! empty($this->xml?->Encabezado?->IdDoc?->FechaVencimientoSecuencia)) {
            return (string) $this->xml?->Encabezado?->IdDoc?->FechaVencimientoSecuencia;
        }

        return null;
    }

    /**
     * Get the modified e-NCF (for Credit/Debit Notes).
     */
    public function getModifiedSequenceNumber(): ?string
    {
        if (! empty($this->xml?->Encabezado?->IdDoc?->eNCFModificado)) {
            return (string) $this->xml?->Encabezado?->IdDoc?->eNCFModificado;
        }

        return null;
    }

    /**
     * Get the modification code.
     */
    public function getModificationCode(): ?string
    {
        if (! empty($this->xml?->Encabezado?->IdDoc?->CodigoModificacion)) {
            return (string) $this->xml?->Encabezado?->IdDoc?->CodigoModificacion;
        }

        return null;
    }

    /**
     * Get additional information about the buyer.
     */
    public function getObservations(): ?string
    {
        if (! empty($this->xml?->Encabezado?->Comprador?->InformacionAdicionalComprador)) {
            return (string) $this->xml?->Encabezado?->Comprador?->InformacionAdicionalComprador;
        }

        return null;
    }

    /**
     * Get all invoice line items.
     *
     * @return array List of items with their quantities, prices, and totals.
     */
    public function getLines(): array
    {
        $lines = [];

        if (! empty($this->xml?->DetallesItems?->Item)) {
            foreach ($this->xml?->DetallesItems?->Item as $item) {
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
     */
    public function getBuyerCorporateName(): ?string
    {
        if (! empty($this->xml?->Encabezado?->Comprador?->RazonSocialComprador)) {
            return (string) $this->xml?->Encabezado?->Comprador?->RazonSocialComprador;
        }

        return null;
    }

    /**
     * Get the buyer's address.
     */
    public function getBuyerAddress(): ?string
    {
        if (! empty($this->xml?->Encabezado?->Comprador?->DireccionComprador)) {
            return (string) $this->xml?->Encabezado?->Comprador?->DireccionComprador;
        }

        return null;
    }

    /**
     * Check if the buyer is a foreigner.
     */
    public function isBuyerForeigner(): bool
    {
        return ! empty($this->xml?->Encabezado?->Comprador?->IdentificadorExtranjero);
    }

    /**
     * Get the sender's corporate name (Razon Social).
     */
    public function getSenderCorporateName(): ?string
    {
        if (! empty($this->xml?->Encabezado?->Emisor->RazonSocialEmisor)) {
            return (string) $this->xml?->Encabezado?->Emisor->RazonSocialEmisor;
        }

        return null;
    }

    /**
     * Get the sender's address.
     */
    public function getSenderAddress(): ?string
    {
        if (! empty($this->xml?->Encabezado?->Emisor->DireccionEmisor)) {
            return (string) $this->xml?->Encabezado?->Emisor->DireccionEmisor;
        }

        return null;
    }

    /**
     * Get the total ITBIS (tax) amount.
     */
    public function getTotalTaxes(): ?float
    {
        if (! empty($this->xml?->Encabezado?->Totales?->TotalITBIS)) {
            return (float) $this->xml?->Encabezado?->Totales?->TotalITBIS;
        }

        return null;
    }

    /**
     * Get the total amount subject to taxes.
     */
    public function getTotalAmountTaxed(): ?float
    {
        if (! empty($this->xml?->Encabezado?->Totales?->MontoGravadoTotal)) {
            return (float) $this->xml?->Encabezado?->Totales?->MontoGravadoTotal;
        }

        return null;
    }

    /**
     * Get the total exempt amount.
     */
    public function getTotalExempt(): ?float
    {
        if (! empty($this->xml?->Encabezado?->Totales?->MontoExento)) {
            return (float) $this->xml?->Encabezado?->Totales?->MontoExento;
        }

        return null;
    }
}
