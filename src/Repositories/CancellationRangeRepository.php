<?php

namespace PlatinumPlace\LaravelDgii\Repositories;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use PlatinumPlace\LaravelDgii\Data\CancellationRange\CancellationRangeResponse;
use PlatinumPlace\LaravelDgii\Exceptions\DgiiRepositoryException;
use PlatinumPlace\LaravelDgii\Repositories\Abstracts\AbstractApiRepository;

class CancellationRangeRepository extends AbstractApiRepository
{
    public function getHttpClient(?string $env = null): PendingRequest
    {
        return Http::dgiiInvoice($env);
    }


    protected function getEndpointKey(): string
    {
        return 'cancellation';
    }


    public function sendCancellationRange(string $token, string $filePath, ?string $env = null): CancellationRangeResponse
    {
        $response = $this->send('send', $token, $filePath, $env);

        return new CancellationRangeResponse($response);
    }
}
