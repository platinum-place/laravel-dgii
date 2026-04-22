<?php

namespace PlatinumPlace\LaravelDgii\Data\Invoice;

use PlatinumPlace\LaravelDgii\Enums\ArecfStatusEnum;

/**
 * Represents the response received after sending an e-CF to DGII.
 */
readonly class InvoiceReceived
{
    /**
     * Create a new class instance.
     *
     * @param  array  $response  The HTTP response data from DGII.
     * @param  ArecfStatusEnum  $arecfStatusEnum  The calculated commercial approval status.
     */
    public function __construct(
        public array $response,
        public ArecfStatusEnum $arecfStatusEnum,
    ) {
        //
    }

    /**
     * Get the descriptive message(s) from the DGII response.
     *
     * Extracts and combines all message values into a single string.
     *
     * @return string|null The combined messages or null if empty.
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
     * Get the tracking ID (trackId) provided by DGII for asynchronous processing.
     *
     * @return string|null The track ID or null if not available.
     */
    public function getTrackId(): ?string
    {
        return $this->response['trackId'] ?? null;
    }

    /**
     * Check if the e-NCF sequence was already consumed (secuenciaUtilizada).
     *
     * @return bool True if the sequence was already used.
     */
    public function getSequenceConsumed(): ?bool
    {
        return $this->response['secuenciaUtilizada'] ?? false;
    }

    /**
     * Get the reception date and time from the DGII response.
     *
     * @return string|null The reception date string or null.
     */
    public function getDate(): ?string
    {
        return $this->response['fechaRecepcion'] ?? null;
    }

    /**
     * Get the overall processing status from the DGII response.
     *
     * @return string|null The status name (e.g., 'Aceptado', 'Rechazado') or null.
     */
    public function getStatus(): ?string
    {
        return $this->response['estado'] ?? null;
    }

    /**
     * Determine if the invoice was not successfully received based on the commercial approval status.
     *
     * @return bool True if NOT_RECEIVED.
     */
    public function notReceived(): bool
    {
        return $this->arecfStatusEnum === ArecfStatusEnum::NOT_RECEIVED;
    }
}
