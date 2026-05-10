<?php

namespace PlatinumPlace\LaravelDgii\Data\Invoice;

use PlatinumPlace\LaravelDgii\Enums\ArecfStatusEnum;

/**
 * Represents the response received after sending an e-CF to DGII.
 *
 * This class wraps the raw response array to provide structured access to track IDs,
 * processing status, and validation messages.
 */
readonly class InvoiceReceived
{
    /**
     * Create a new InvoiceReceived instance.
     *
     * @param  array  $response  The raw HTTP response data from DGII.
     * @param  ArecfStatusEnum|null  $arecfStatusEnum  The calculated commercial approval status (optional).
     */
    public function __construct(
        public array $response,
        public ?ArecfStatusEnum $arecfStatusEnum = null,
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
        // Check if there are multiple messages in the response
        if (! empty($this->response['mensajes'])) {
            // Extract the 'valor' column or the whole element if 'valor' is missing
            $messages = array_column($this->response['mensajes'], 'valor');

            if (empty($messages)) {
                $messages = array_column($this->response['mensajes'], null);
            }

            // Return all messages joined by spaces
            return implode(' ', $messages);
        }

        // Check if there is a single 'mensaje' field
        if (! empty($this->response['mensaje'])) {
            // Handle both array and string formats
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
        // Return the 'trackId' field if it exists
        return $this->response['trackId'] ?? null;
    }

    /**
     * Check if the e-NCF sequence was already consumed (secuenciaUtilizada).
     *
     * @return bool|null True if the sequence was already used.
     */
    public function getSequenceConsumed(): ?bool
    {
        // Return the 'secuenciaUtilizada' boolean or false as default
        return $this->response['secuenciaUtilizada'] ?? false;
    }

    /**
     * Get the reception date and time from the DGII response.
     *
     * @return string|null The reception date string or null.
     */
    public function getDate(): ?string
    {
        // Return the 'fechaRecepcion' field if it exists
        return $this->response['fechaRecepcion'] ?? null;
    }

    /**
     * Get the overall processing status from the DGII response.
     *
     * @return string|null The status name (e.g., 'Aceptado', 'Rechazado') or null.
     */
    public function getStatus(): ?string
    {
        // Return the 'estado' field if it exists
        return $this->response['estado'] ?? null;
    }

    /**
     * Determine if the invoice was not successfully received based on the commercial approval status.
     *
     * @return bool True if NOT_RECEIVED.
     */
    public function notReceived(): bool
    {
        // Compare the current ARECF status with the NOT_RECEIVED constant
        return $this->arecfStatusEnum === ArecfStatusEnum::NOT_RECEIVED;
    }
}
