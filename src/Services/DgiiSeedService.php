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
        protected ReceiveSeedAction $receiveSeedAction,
    ) {
        //
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function request(?string $env = null): string
    {
        return $this->seedClient->fetch($env);
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function receive(string $signedXml, ?string $env = null): array
    {
        return $this->receiveSeedAction->handle($signedXml, $env);
    }
}
