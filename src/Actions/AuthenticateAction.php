<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Cache;
use PlatinumPlace\LaravelDgii\Clients\DgiiClient;
use PlatinumPlace\LaravelDgii\Helpers\StorageHelper;
use PlatinumPlace\LaravelDgii\Services\SignXmlService;

class AuthenticateAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected DgiiClient $client,
        protected SignXmlService $signXml,
        protected StorageHelper $storageHelper,
        protected ReceiveSeedAction $receiveSeedAction
    ) {
        //
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    protected function refreshToken(?string $env = null, ?string $certPath = null, ?string $certPassword = null): array
    {
        $xml = $this->client->fetchAuthXml($env);

        $signedXml = $this->signXml->handle($xml, $certPath, $certPassword);

        return $this->receiveSeedAction->handle($signedXml, $env);
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function handle(?string $env = null, ?string $certPath = null, ?string $certPassword = null): string
    {
        $cacheKey = config('dgii.cache.prefix').md5($certPath.$env);

        if ($token = Cache::get($cacheKey)) {
            return $token;
        }

        $response = $this->refreshToken($env, $certPath, $certPassword);

        $ttl = max(1, (strtotime($response['expira']) - now()->timestamp) - config('dgii.cache.buffer'));

        Cache::put($cacheKey, $response['token'], $ttl);

        return $response['token'];
    }
}
