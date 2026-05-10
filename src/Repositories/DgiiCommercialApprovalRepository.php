<?php

namespace PlatinumPlace\LaravelDgii\Repositories;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class DgiiCommercialApprovalRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function send(string $token, string $filePath, ?string $env = null): array
    {
        return Http::dgiiEcf($env)
            ->withToken($token)
            ->attachXml($filePath)
            ->post(config('dgii.endpoints.approval.send'))
            ->json();
    }
}
