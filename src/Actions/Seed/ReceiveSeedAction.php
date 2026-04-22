<?php

namespace PlatinumPlace\LaravelDgii\Actions\Seed;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use PlatinumPlace\LaravelDgii\Clients\SeedClient;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;

/**
 * Action to receive and validate a signed seed with DGII to obtain a token.
 */
class ReceiveSeedAction
{
    /**
     * Create a new class instance.
     *
     * @param  StorageRepository  $storageService  Storage service instance.
     * @param  SeedClient  $seedClient  Seed client instance.
     */
    public function __construct(
        protected StorageRepository $storageService,
        protected SeedClient $seedClient,
    ) {
        //
    }

    /**
     * Validate the signed seed XML with DGII to obtain an access token.
     *
     * @param  string  $signedXml  Signed seed XML content.
     * @param  string|null  $env  The environment to use.
     * @return array Response data (token, expiration date).
     *
     * @throws ConnectionException|RequestException
     */
    public function handle(string $signedXml, ?string $env = null): array
    {
        $xmlPath = $this->storageService->putXml($signedXml, now()->timestamp.'-semilla');

        return $this->seedClient->fetchToken($xmlPath, $env);
    }
}
