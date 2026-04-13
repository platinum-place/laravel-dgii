<?php

namespace PlatinumPlace\LaravelDgii\ValueObjects;

use SimpleXMLElement;

class InvoiceValueObject
{
    protected SimpleXMLElement $xml;

    /**
     * Create a new class instance.
     */
    public function __construct(string $xml)
    {
        $this->xml = simplexml_load_string($xml);
    }

    public function getSequenceNumber(): ?string
    {
        if (!empty($this->xml?->Encabezado?->IdDoc)) {
            return (string)$this->xml?->Encabezado?->IdDoc?->eNCF;
        }

        return null;
    }

    public function getSecurityCode(): ?string
    {
        if (!empty($this->xml?->Encabezado?->CodigoSeguridadeCF)) {
            return (string)$this->xml?->Encabezado?->CodigoSeguridadeCF;
        }

        if (!empty($this->xml?->Signature?->SignatureValue)) {
            return substr((string)$this->xml?->Signature?->SignatureValue, 0, 6);
        }

        return null;
    }

    public function getSignatureDate(): ?string
    {
        if (!empty($this->xml?->FechaHoraFirma)) {
            return (string)$this->xml?->FechaHoraFirma;
        }

        return null;
    }

    public function getInvoiceType(): ?string
    {
        if (!empty($this->xml?->Encabezado?->IdDoc?->TipoeCF)) {
            return (string)$this->xml?->Encabezado?->IdDoc?->TipoeCF;
        }

        return null;
    }

    public function getInvoiceTotal(): ?string
    {
        if (!empty($this->xml?->Encabezado?->Totales?->MontoTotal)) {
            return (string)$this->xml?->Encabezado?->Totales?->MontoTotal;
        }

        return null;
    }

    public function isRfce(): ?string
    {
        return !empty($this->xml?->Encabezado?->CodigoSeguridadeCF);
    }

    public function isConsumeInvoice(): bool
    {
        $type = (int)$this->getInvoiceType();
        $total = (float)$this->getInvoiceTotal();

        return
            $this->isRfce() ||
            $type === config('dgii.rules.fc_type') && $total < config('dgii.rules.fc_limit');
    }

    public function getSenderIdentification(): ?string
    {
        if (!empty($this->xml?->Encabezado?->Emisor->RNCEmisor)) {
            return (string)$this->xml?->Encabezado?->Emisor->RNCEmisor;
        }

        return null;
    }

    public function getReleaseDate(): ?string
    {
        if (!empty($this->xml?->Encabezado?->Emisor?->FechaEmision)) {
            return (string)$this->xml?->Encabezado?->Emisor?->FechaEmision;
        }

        return null;
    }

    public function getBuyerIdentification(): ?string
    {
        if (!empty($this->xml?->Encabezado?->Comprador?->IdentificadorExtranjero)) {
            return (string)$this->xml?->Encabezado?->Comprador?->IdentificadorExtranjero;
        }

        if (!empty($this->xml?->Encabezado?->Comprador?->RNCComprador)) {
            return (string)$this->xml?->Encabezado?->Comprador?->RNCComprador;
        }

        return null;
    }
}