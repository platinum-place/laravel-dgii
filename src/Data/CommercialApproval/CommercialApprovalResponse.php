<?php

namespace PlatinumPlace\LaravelDgii\Data\CommercialApproval;

readonly class CommercialApprovalResponse
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
        return $this->response['estado'] ?? null;
    }

    public function notReceived(): bool
    {
        return $this->response['receive'] === false;
    }
}
