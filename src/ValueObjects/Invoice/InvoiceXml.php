<?php

namespace PlatinumPlace\LaravelDgii\ValueObjects\Invoice;

use AllowDynamicProperties;
use SimpleXMLElement;

#[AllowDynamicProperties]
class InvoiceXml
{
    protected SimpleXMLElement $xml;

    public string $xmlContent;

    /**
     * Create a new class instance.
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(string $xml)
    {
        $this->xmlContent = $xml;

        libxml_use_internal_errors(true);
        $loadedXml = simplexml_load_string($xml);

        if ($loadedXml === false) {
            $errors = libxml_get_errors();
            libxml_clear_errors();
            throw new \InvalidArgumentException('El contenido XML no es válido: '.($errors[0]->message ?? 'Error desconocido'));
        }

        $this->xmlSigner = $loadedXml;
    }

    /**
     * Retornar el XML sin la firma digital (útil para auditoría o pre-procesamiento).
     */
    public function withoutSignature(): ?string
    {
        $xml = $this->xmlSigner;

        $xml->registerXPathNamespace('ds', 'http://www.w3.org/2000/09/xmldsig#');

        foreach ($xml->xpath('//ds:Signature') as $signature) {
            unset($signature[0]);
        }

        return $xml->asXML();
    }

    /**
     * Obtener el e-NCF (Número de Comprobante Fiscal Electrónico).
     */
    public function getSequenceNumber(): ?string
    {
        if (! empty($this->xmlSigner?->Encabezado?->IdDoc)) {
            return (string) $this->xmlSigner?->Encabezado?->IdDoc?->eNCF;
        }

        return null;
    }

    /**
     * Obtener el código de seguridad de 6 dígitos del e-CF.
     */
    public function getSecurityCode(): ?string
    {
        if (! empty($this->xmlSigner?->Encabezado?->CodigoSeguridadeCF)) {
            return (string) $this->xmlSigner?->Encabezado?->CodigoSeguridadeCF;
        }

        if (! empty($this->xmlSigner?->Signature?->SignatureValue)) {
            return substr((string) $this->xmlSigner?->Signature?->SignatureValue, 0, 6);
        }

        return null;
    }

    /**
     * Obtener la fecha y hora de la firma digital.
     */
    public function getSignatureDate(): ?string
    {
        if (! empty($this->xmlSigner?->FechaHoraFirma)) {
            return (string) $this->xmlSigner?->FechaHoraFirma;
        }

        return null;
    }

    /**
     * Obtener el tipo de comprobante (ej: 31, 32, 33, 41).
     */
    public function getInvoiceType(): ?string
    {
        if (! empty($this->xmlSigner?->Encabezado?->IdDoc?->TipoeCF)) {
            return (string) $this->xmlSigner?->Encabezado?->IdDoc?->TipoeCF;
        }

        return null;
    }

    /**
     * Obtener el monto total del comprobante.
     */
    public function getTotalAmount(): ?string
    {
        if (! empty($this->xmlSigner?->Encabezado?->Totales?->MontoTotal)) {
            return (string) $this->xmlSigner?->Encabezado?->Totales?->MontoTotal;
        }

        return null;
    }

    /**
     * Determinar si el XML corresponde a un RFCE (Resumen de Consumo).
     */
    public function isRfce(): bool
    {
        return ! empty($this->xmlSigner?->Encabezado?->CodigoSeguridadeCF);
    }

    /**
     * Determinar si la factura es de consumo (B32) basado en tipo y monto límite.
     */
    public function isConsumeInvoice(): bool
    {
        $type = (int) $this->getInvoiceType();
        $total = (float) $this->getTotalAmount();

        return
            $this->isRfce() ||
            $type === config('dgii.rules.fc_type') && $total < config('dgii.rules.fc_limit');
    }

    public function getSenderIdentification(): ?string
    {
        if (! empty($this->xmlSigner?->Encabezado?->Emisor->RNCEmisor)) {
            return (string) $this->xmlSigner?->Encabezado?->Emisor->RNCEmisor;
        }

        return null;
    }

    public function getReleaseDate(): ?string
    {
        if (! empty($this->xmlSigner?->Encabezado?->Emisor?->FechaEmision)) {
            return (string) $this->xmlSigner?->Encabezado?->Emisor?->FechaEmision;
        }

        return null;
    }

    public function getBuyerIdentification(): ?string
    {
        if (! empty($this->xmlSigner?->Encabezado?->Comprador?->IdentificadorExtranjero)) {
            return (string) $this->xmlSigner?->Encabezado?->Comprador?->IdentificadorExtranjero;
        }

        if (! empty($this->xmlSigner?->Encabezado?->Comprador?->RNCComprador)) {
            return (string) $this->xmlSigner?->Encabezado?->Comprador?->RNCComprador;
        }

        return null;
    }

    public function getXmlName(): ?string
    {
        if (! empty($this->xmlSigner?->Encabezado)) {
            return $this->getSenderIdentification().$this->getSequenceNumber();
        }

        return null;
    }

    public function getSequenceDueDate(): ?string
    {
        if (! empty($this->xmlSigner?->Encabezado?->IdDoc?->FechaVencimientoSecuencia)) {
            return (string) $this->xmlSigner?->Encabezado?->IdDoc?->FechaVencimientoSecuencia;
        }

        return null;
    }

    public function getModifiedSequenceNumber(): ?string
    {
        if (! empty($this->xmlSigner?->Encabezado?->IdDoc?->eNCFModificado)) {
            return (string) $this->xmlSigner?->Encabezado?->IdDoc?->eNCFModificado;
        }

        return null;
    }

    public function getModificationCode(): ?string
    {
        if (! empty($this->xmlSigner?->Encabezado?->IdDoc?->CodigoModificacion)) {
            return (string) $this->xmlSigner?->Encabezado?->IdDoc?->CodigoModificacion;
        }

        return null;
    }

    public function getObservations(): ?string
    {
        if (! empty($this->xmlSigner?->Encabezado?->Comprador?->InformacionAdicionalComprador)) {
            return (string) $this->xmlSigner?->Encabezado?->Comprador?->InformacionAdicionalComprador;
        }

        return null;
    }

    public function getLines(): array
    {
        $lines = [];

        if (! empty($this->xmlSigner?->DetallesItems?->Item)) {
            foreach ($this->xmlSigner?->DetallesItems?->Item as $item) {
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

    public function getBuyerCorporateName(): ?string
    {
        if (! empty($this->xmlSigner?->Encabezado?->Comprador?->RazonSocialComprador)) {
            return (string) $this->xmlSigner?->Encabezado?->Comprador?->RazonSocialComprador;
        }

        return null;
    }

    public function getBuyerAddress(): ?string
    {
        if (! empty($this->xmlSigner?->Encabezado?->Comprador?->DireccionComprador)) {
            return (string) $this->xmlSigner?->Encabezado?->Comprador?->DireccionComprador;
        }

        return null;
    }

    public function isBuyerForeigner(): bool
    {
        return ! empty($this->xmlSigner?->Encabezado?->Comprador?->IdentificadorExtranjero);
    }

    public function getSenderCorporateName(): ?string
    {
        if (! empty($this->xmlSigner?->Encabezado?->Emisor->RazonSocialEmisor)) {
            return (string) $this->xmlSigner?->Encabezado?->Emisor->RazonSocialEmisor;
        }

        return null;
    }

    public function getSenderAddress(): ?string
    {
        if (! empty($this->xmlSigner?->Encabezado?->Emisor->DireccionEmisor)) {
            return (string) $this->xmlSigner?->Encabezado?->Emisor->DireccionEmisor;
        }

        return null;
    }

    public function getTotalTaxes(): ?float
    {
        if (! empty($this->xmlSigner?->Encabezado?->Totales?->TotalITBIS)) {
            return (float) $this->xmlSigner?->Encabezado?->Totales?->TotalITBIS;
        }

        return null;
    }

    public function getTotalAmountTaxed(): ?float
    {
        if (! empty($this->xmlSigner?->Encabezado?->Totales?->MontoGravadoTotal)) {
            return (float) $this->xmlSigner?->Encabezado?->Totales?->MontoGravadoTotal;
        }

        return null;
    }

    public function getTotalExempt(): ?float
    {
        if (! empty($this->xmlSigner?->Encabezado?->Totales?->MontoExento)) {
            return (float) $this->xmlSigner?->Encabezado?->Totales?->MontoExento;
        }

        return null;
    }
}
