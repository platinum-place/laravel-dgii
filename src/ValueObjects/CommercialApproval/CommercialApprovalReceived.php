<?php

namespace PlatinumPlace\LaravelDgii\ValueObjects\Invoice;

use PlatinumPlace\LaravelDgii\Enums\ArecfStatusEnum;

readonly class InvoiceReceived
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public array $response,
        public ArecfStatusEnum $arecfStatusEnum,
    ) {
        //
    }

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

    public function getTrackId(): ?string
    {
        return $this->response['trackId'] ?? null;
    }

    public function getSequenceConsumed(): ?bool
    {
        return $this->response['secuenciaUtilizada'] ?? false;
    }

    public function getDate(): ?string
    {
        return $this->response['fechaRecepcion'] ?? null;
    }

    public function getStatus(): ?string
    {
        return $this->response['estado'] ?? null;
    }
}
