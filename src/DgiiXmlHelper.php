<?php

namespace PlatinumPlace\LaravelDgii;

use SimpleXMLElement;

class DgiiXmlHelper
{
    protected SimpleXMLElement $xml;

    /**
     * Create a new class instance.
     */
    public function __construct(string $xml)
    {
        $this->xml = simplexml_load_string($xml);
    }

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

    public function getSequenceNumber(): ?string
    {
        if (! empty($this->xml?->Encabezado?->IdDoc)) {
            return (string) $this->xml?->Encabezado?->IdDoc?->eNCF;
        }

        if (! empty($this->xml?->DetalleAprobacionComercial?->eNCF)) {
            return (string) $this->xml?->DetalleAprobacionComercial?->eNCF;
        }

        if (! empty($this->xml?->DetalleAcusedeRecibo?->eNCF)) {
            return (string) $this->xml?->DetalleAcusedeRecibo?->eNCF;
        }

        return null;
    }

    public function getArecfStatus(): ?string
    {
        if (! empty($this->xml?->DetalleAcusedeRecibo?->Estado)) {
            return (string) $this->xml?->DetalleAcusedeRecibo?->Estado;
        }

        return null;
    }

    public function getArecfCode(): ?string
    {
        if (! empty($this->xml?->DetalleAcusedeRecibo?->CodigoMotivoNoRecibido)) {
            return (string) $this->xml?->DetalleAcusedeRecibo?->CodigoMotivoNoRecibido;
        }

        return null;
    }

    public function isAcecf(): bool
    {
        return ! empty($this->xml?->DetalleAprobacionComercial);
    }

    public function isArecf(): bool
    {
        return ! empty($this->xml?->DetalleAcusedeRecibo);
    }

    public function getSignatureDate(): ?string
    {
        if (! empty($this->xml?->FechaHoraFirma)) {
            return (string) $this->xml?->FechaHoraFirma;
        }

        return null;
    }

    public function getXmlName(): ?string
    {
        if (! empty($this->xml?->Encabezado)) {
            return $this->getSenderIdentification().$this->getSequenceNumber();
        }

        if (! empty($this->xml?->DetalleAprobacionComercial)) {
            return $this->getBuyerIdentification().$this->getSequenceNumber();
        }

        if (! empty($this->xml?->DetalleAcusedeRecibo)) {
            return $this->getBuyerIdentification().$this->getSequenceNumber();
        }

        return null;
    }

    public function getBuyerIdentification(): ?string
    {
        if (! empty($this->xml?->Encabezado?->Comprador?->IdentificadorExtranjero)) {
            return (string) $this->xml?->Encabezado?->Comprador?->IdentificadorExtranjero;
        }

        if (! empty($this->xml?->Encabezado?->Comprador?->RNCComprador)) {
            return (string) $this->xml?->Encabezado?->Comprador?->RNCComprador;
        }

        if (! empty($this->xml?->DetalleAprobacionComercial?->RNCComprador)) {
            return (string) $this->xml?->DetalleAprobacionComercial?->RNCComprador;
        }

        if (! empty($this->xml?->DetalleAcusedeRecibo?->RNCComprador)) {
            return (string) $this->xml?->DetalleAcusedeRecibo?->RNCComprador;
        }

        return null;
    }

    public function getBuyerCorporateName(): ?string
    {
        if (! empty($this->xml?->Encabezado?->Comprador?->RazonSocialComprador)) {
            return (string) $this->xml?->Encabezado?->Comprador?->RazonSocialComprador;
        }

        return null;
    }

    public function getBuyerAddress(): ?string
    {
        if (! empty($this->xml?->Encabezado?->Comprador?->DireccionComprador)) {
            return (string) $this->xml?->Encabezado?->Comprador?->DireccionComprador;
        }

        return null;
    }

    public function isBuyerForeigner(): bool
    {
        return ! empty($this->xml?->Encabezado?->Comprador?->IdentificadorExtranjero);
    }

    public function getReleaseDate(): ?string
    {
        if (! empty($this->xml?->Encabezado?->Emisor?->FechaEmision)) {
            return (string) $this->xml?->Encabezado?->Emisor?->FechaEmision;
        }

        return null;
    }

    public function getInvoiceTotal(): ?string
    {
        if (! empty($this->xml?->Encabezado?->Totales?->MontoTotal)) {
            return (string) $this->xml?->Encabezado?->Totales?->MontoTotal;
        }

        return null;
    }

    public function getSenderIdentification(): ?string
    {
        if (! empty($this->xml?->Encabezado?->Emisor->RNCEmisor)) {
            return (string) $this->xml?->Encabezado?->Emisor->RNCEmisor;
        }

        return null;
    }

    public function getSenderCorporateName(): ?string
    {
        if (! empty($this->xml?->Encabezado?->Emisor->RazonSocialEmisor)) {
            return (string) $this->xml?->Encabezado?->Emisor->RazonSocialEmisor;
        }

        return null;
    }

    public function getSenderAddress(): ?string
    {
        if (! empty($this->xml?->Encabezado?->Emisor->DireccionEmisor)) {
            return (string) $this->xml?->Encabezado?->Emisor->DireccionEmisor;
        }

        return null;
    }

    public function getInvoiceType(): ?string
    {
        if (! empty($this->xml?->Encabezado?->IdDoc?->TipoeCF)) {
            return (string) $this->xml?->Encabezado?->IdDoc?->TipoeCF;
        }

        return null;
    }

    public function isConsumeInvoice(): bool
    {
        $type = (int)$this->getInvoiceType();
        $total = (float) $this->getInvoiceTotal();

        return $type === config('dgii.rules.fc_type') && $total < config('dgii.rules.fc_limit');
    }
}
