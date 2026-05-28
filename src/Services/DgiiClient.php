<?php

namespace PlatinumPlace\LaravelDgii\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class DgiiClient
{
    /**
//     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * @throws ConnectionException
     */
    public function sendAuthSeed(string $env, string $filePath): array
    {
        $response = Http::dgiiInvoice($env)
            ->attachXml($filePath)
            ->post(config('dgii.endpoints.auth.validate'));

        return $response->json();
    }

    /**
     * @throws ConnectionException
     */
    public function fetchAuthSeed(string $env): string
    {
        $response = Http::dgiiInvoice($env)
            ->get(config('dgii.endpoints.auth.seed'));

        return $response->body();
    }

    /**
     * @throws ConnectionException
     */
    public function sendCancellationRange(string $env, string $token, string $filePath): array
    {
        $response = Http::dgiiInvoice($env)
            ->withToken($token)
            ->attachXml($filePath)
            ->post(config('dgii.endpoints.cancellation.send'));

        return $response->json();
    }

    /**
     * @throws ConnectionException
     */
    public function fetchInvoices(string $env, string $token, string $senderIdentification, string $sequenceNumber): array
    {
        $response = Http::dgiiInvoice($env)
            ->withToken($token)
            ->get(config('dgii.endpoints.invoice.list'), [
                'RncEmisor' => $senderIdentification,
                'Encf' => $sequenceNumber,
            ]);

        return $response->json();
    }

    /**
     * @throws ConnectionException
     */
    public function findInvoiceByTrackId(string $env, string $token, string $trackId): array
    {
        $response = Http::dgiiInvoice($env)
            ->withToken($token)
            ->get(config('dgii.endpoints.invoice.status'), [
                'trackid' => $trackId,
            ]);

        return $response->json();
    }

    /**
     * @throws ConnectionException
     */
    public function sendInvoice(string $env, string $token, string $filePath): array
    {
        $response = Http::dgiiInvoice($env)
            ->withToken($token)
            ->attachXml($filePath)
            ->post(config('dgii.endpoints.invoice.send'));

        return $response->json();
    }

    /**
     * @throws ConnectionException
     */
    public function fetchConsumerInvoice(string $env, string $token, string $senderIdentification, string $sequenceNumber, string $securityCode): array
    {
        $response = Http::dgiiConsumerInvoice($env)
            ->withToken($token)
            ->get(config('dgii.endpoints.consumer_invoice.status'), [
                'RNC_Emisor' => $senderIdentification,
                'ENCF' => $sequenceNumber,
                'Cod_Seguridad_eCF' => $securityCode,
            ]);

        return $response->json();
    }

    /**
     * @throws ConnectionException
     */
    public function sendConsumerInvoice(string $env, string $token, string $filePath): array
    {
        $response = Http::dgiiConsumerInvoice($env)
            ->withToken($token)
            ->attachXml($filePath)
            ->post(config('dgii.endpoints.consumer_invoice.send'));

        return $response->json();
    }

    /**
     * @throws ConnectionException
     */
    public function sendCommercialApproval(string $env, string $token, string $filePath): array
    {
        $response = Http::dgiiInvoice($env)
            ->withToken($token)
            ->attachXml($filePath)
            ->post(config('dgii.endpoints.approval.send'));

        return $response->json();
    }

    /**
     * @throws ConnectionException
     */
    public function fetchEnvironmentStatus(string $env): array
    {
        $response = Http::dgiiStatus()
            ->get(config('dgii.endpoints.status.environment'), [
                'ambiente' => match ($env) {
                    'testecf' => 1,
                    'ecf' => 2,
                    'certecf' => 3,
                },
            ]);

        return $response->json();
    }

    /**
     * @throws ConnectionException
     */
    public function fetchMaintenanceWindows(): array
    {
        $response = Http::dgiiStatus()
            ->get(config('dgii.endpoints.status.maintenance'));

        return $response->json();
    }

    /**
     * @throws ConnectionException
     */
    public function fetchServiceStatus(): array
    {
        $response = Http::dgiiStatus()
            ->get(config('dgii.endpoints.status.services'));

        return $response->json();
    }
}
