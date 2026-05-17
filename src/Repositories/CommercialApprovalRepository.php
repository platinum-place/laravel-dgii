<?php

namespace PlatinumPlace\LaravelDgii\Repositories;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use PlatinumPlace\LaravelDgii\Data\CommercialApproval\CommercialApprovalResponse;
use PlatinumPlace\LaravelDgii\Exceptions\DgiiRepositoryException;
use PlatinumPlace\LaravelDgii\Repositories\Abstracts\AbstractApiRepository;

class CommercialApprovalRepository extends AbstractApiRepository
{
    public function getHttpClient(?string $env = null): PendingRequest
    {
        return Http::dgiiInvoice($env);
    }

    protected function getEndpointKey(): string
    {
        return 'approval';
    }

    public function sendCommercialApproval(string $token, string $filePath, ?string $env = null): CommercialApprovalResponse
    {
        $response = $this->send('send', $token, $filePath, $env);

        return new CommercialApprovalResponse($response);
    }
}
