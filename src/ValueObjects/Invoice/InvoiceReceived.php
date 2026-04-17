<?php

namespace PlatinumPlace\LaravelDgii\ValueObjects\Invoice;

use PlatinumPlace\LaravelDgii\Enums\ArecfStatusEnum;

/**
 * Represents the response received after sending an e-CF to DGII.
 */
readonly class InvoiceReceived
{
    /**
     * Create a new class instance.
     *
     * @param array $response The HTTP response data from DGII.
     * @param ArecfStatusEnum $arecfStatusEnum The calculated commercial approval status.
     */
    public function __construct(
        public array $response,
        public ArecfStatusEnum $arecfStatusEnum,
    ) {
        //
    }

    /**
     * Get the descriptive message(s) from the DGII response.
     */
    public function getMessage(): ?string
    {
        if (! empty($this->response['mensajes'])) {
            $messages = array_column($this->response['mensajes'], 'valor');

            if (empty($messages)) {
                $messages = array_column($this->response['mensajes'], null);
            }

            return implode(' ', $messages);
        }

        if (! empty($this->response['mensaje'])) {
            return is_array($this->response['mensaje']) ? implode(' ', $this->response['mensaje']) : $this->response['mensaje'];
        }

        return null;
    }

    /**
     * Get the trackId provided by DGII for async tracking.
     */
    public function getTrackId(): ?string
    {
        return $this->response['trackId'] ?? null;
    }

    /**
     * Check if the sequence was already consumed (secuenciaUtilizada).
     */
    public function getSequenceConsumed(): ?bool
    {
        return $this->response['secuenciaUtilizada'] ?? false;
    }

    /**
     * Get the reception date from the DGII response.
     */
    public function getDate(): ?string
    {
        return $this->response['fechaRecepcion'] ?? null;
    }

    /**
     * Get the processing status from the DGII response.
     */
    public function getStatus(): ?string
    {
        return $this->response['estado'] ?? null;
    }
}
