<?php

namespace PlatinumPlace\LaravelDgii\Data\CancellationRange;

readonly class CancellationRangeResponse
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public array $response,
    ) {
        //
    }

    public function getResponse(): array
    {
        return $this->response;
    }

    public function getStatus(): ?string
    {
        return $this->response['nombre'] ?? null;
    }

    public function notReceived(): bool
    {
        return $this->response['receive'] === false;
    }
}
