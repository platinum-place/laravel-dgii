<?php

namespace PlatinumPlace\LaravelDgii\ValueObjects;

use SimpleXMLElement;

class InvoiceXml
{
    protected SimpleXMLElement $xml;

    /**
     * Create a new class instance.
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(string $xml)
    {
        libxml_use_internal_errors(true);
        $loadedXml = simplexml_load_string($xml);

        if ($loadedXml === false) {
            $errors = libxml_get_errors();
            libxml_clear_errors();
            throw new \InvalidArgumentException('El contenido XML no es válido: '.($errors[0]->message ?? 'Error desconocido'));
        }

        $this->xml = $loadedXml;
    }

    /**
     * Retornar el XML sin la firma digital (útil para auditoría o pre-procesamiento).
     *
     * @return string|null
     */
    public function withoutSignature(): ?string
    {
        $xml = $this->xml;

        $xml->registerXPathNamespace('ds', 'http://www.w3.org/2000/09/xmldsig#');

        foreach ($xml->xpath('//ds:Signature') as $signature) {
            unset($signature[0]);
        }

        return $xml->asXML();
    }

    /**
     * Obtener el e-NCF (Número de Comprobante Fiscal Electrónico).
     *
     * @return string|null
     */
    public function getSequenceNumber(): ?string
    {
        if (! empty($this->xml?->Encabezado?->IdDoc)) {
            return (string) $this->xml?->Encabezado?->IdDoc?->eNCF;
        }

        return null;
    }

    /**
     * Obtener el código de seguridad de 6 dígitos del e-CF.
     *
     * @return string|null
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
     * Obtener la fecha y hora de la firma digital.
     *
     * @return string|null
     */
    public function getSignatureDate(): ?string
    {
        if (! empty($this->xml?->FechaHoraFirma)) {
            return (string) $this->xml?->FechaHoraFirma;
        }

        return null;
    }

    /**
     * Obtener el tipo de comprobante (ej: 31, 32, 33, 41).
     *
     * @return string|null
     */
    public function getInvoiceType(): ?string
    {
        if (! empty($this->xml?->Encabezado?->IdDoc?->TipoeCF)) {
            return (string) $this->xml?->Encabezado?->IdDoc?->TipoeCF;
        }

        return null;
    }

    /**
     * Obtener el monto total del comprobante.
     *
     * @return string|null
     */
    public function getTotalAmount(): ?string
    {
        if (! empty($this->xml?->Encabezado?->Totales?->MontoTotal)) {
            return (string) $this->xml?->Encabezado?->Totales?->MontoTotal;
        }

        return null;
    }

    /**
     * Determinar si el XML corresponde a un RFCE (Resumen de Consumo).
     *
     * @return bool
     */
    public function isRfce(): bool
    {
        return ! empty($this->xml?->Encabezado?->CodigoSeguridadeCF);
    }

    /**
     * Determinar si la factura es de consumo (B32) basado en tipo y monto límite.
     *
     * @return bool
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
        if (! empty($this->xml?->Encabezado?->Emisor->RNCEmisor)) {
            return (string) $this->xml?->Encabezado?->Emisor->RNCEmisor;
        }

        return null;
    }

    public function getReleaseDate(): ?string
    {
        if (! empty($this->xml?->Encabezado?->Emisor?->FechaEmision)) {
            return (string) $this->xml?->Encabezado?->Emisor?->FechaEmision;
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

        return null;
    }

    public function getXmlName(): ?string
    {
        if (! empty($this->xml?->Encabezado)) {
            return $this->getSenderIdentification().$this->getSequenceNumber();
        }

        return null;
    }

    public function getSequenceDueDate(): ?string
    {
        if (! empty($this->xml?->Encabezado?->IdDoc?->FechaVencimientoSecuencia)) {
            return (string) $this->xml?->Encabezado?->IdDoc?->FechaVencimientoSecuencia;
        }

        return null;
    }

    public function getModifiedSequenceNumber(): ?string
    {
        if (! empty($this->xml?->Encabezado?->IdDoc?->eNCFModificado)) {
            return (string) $this->xml?->Encabezado?->IdDoc?->eNCFModificado;
        }

        return null;
    }

    public function getModificationCode(): ?string
    {
        if (! empty($this->xml?->Encabezado?->IdDoc?->CodigoModificacion)) {
            return (string) $this->xml?->Encabezado?->IdDoc?->CodigoModificacion;
        }

        return null;
    }

    public function getObservations(): ?string
    {
        if (! empty($this->xml?->Encabezado?->Comprador?->InformacionAdicionalComprador)) {
            return (string) $this->xml?->Encabezado?->Comprador?->InformacionAdicionalComprador;
        }

        return null;
    }

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

    public function getTotalTaxes(): ?float
    {
        if (! empty($this->xml?->Encabezado?->Totales?->TotalITBIS)) {
            return (float) $this->xml?->Encabezado?->Totales?->TotalITBIS;
        }

        return null;
    }

    public function getTotalAmountTaxed(): ?float
    {
        if (! empty($this->xml?->Encabezado?->Totales?->MontoGravadoTotal)) {
            return (float) $this->xml?->Encabezado?->Totales?->MontoGravadoTotal;
        }

        return null;
    }

    public function getTotalExempt(): ?float
    {
        if (! empty($this->xml?->Encabezado?->Totales?->MontoExento)) {
            return (float) $this->xml?->Encabezado?->Totales?->MontoExento;
        }

        return null;
    }
}
