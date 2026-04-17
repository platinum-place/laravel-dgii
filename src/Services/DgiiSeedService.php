<?php

namespace PlatinumPlace\LaravelDgii\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use PlatinumPlace\LaravelDgii\Actions\Seed\ReceiveSeedAction;
use PlatinumPlace\LaravelDgii\Clients\SeedClient;
use PlatinumPlace\LaravelDgii\Support\StorageService;

class DgiiSeedService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected StorageService $storageService,
        protected SeedClient $seedClient,
    ) {
        //
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function requestXml(?string $env = null): string
    {
        return $this->seedClient->fetch($env);
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function requestToken(string $signedXml, ?string $env = null): array
    {
        return app(ReceiveSeedAction::class)->handle($signedXml, $env);
    }
}
