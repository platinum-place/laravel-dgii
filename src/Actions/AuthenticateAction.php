<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Cache;
use PlatinumPlace\LaravelDgii\Actions\Seed\ReceiveSeedAction;
use PlatinumPlace\LaravelDgii\Clients\SeedClient;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;
use PlatinumPlace\LaravelDgii\Support\XmlSigner;

/**
 * Action to handle the complete DGII authentication lifecycle.
 *
 * It manages token generation (Seed -> Sign -> Validate) and caching
 * to optimize performance and prevent unnecessary requests to DGII.
 */
class AuthenticateAction
{
    /**
     * Create a new authentication action instance.
     *
     * @param  SeedClient  $seedClient  Seed client instance.
     * @param  XmlSigner  $xmlSigner  XML signing service.
     * @param  StorageRepository  $storageService  Storage service.
     * @param  ReceiveSeedAction  $receiveSeedAction  Action to receive and validate seeds.
     */
    public function __construct(
        protected SeedClient $seedClient,
        protected XmlSigner $xmlSigner,
        protected StorageRepository $storageService,
        protected ReceiveSeedAction $receiveSeedAction,
    ) {
        //
    }

    /**
     * Perform the process of obtaining a new token (Seed -> Sign -> Validate).
     *
     * @param  string|null  $env  The environment to use.
     * @param  string|null  $certPath  Optional certificate path.
     * @param  string|null  $certPassword  Optional certificate password.
     * @return array Token data including expiration.
     *
     * @throws ConnectionException|RequestException
     */
    private function refreshToken(?string $env = null, ?string $certPath = null, ?string $certPassword = null): array
    {
        $xml = $this->seedClient->fetch($env);

        $signedXml = $this->xmlSigner->sign($xml, $certPath, $certPassword);

        return $this->receiveSeedAction->handle($signedXml, $env);
    }

    /**
     * Obtain a valid authentication token for DGII services.
     *
     * The token is cached to optimize performance.
     *
     * @param  string|null  $env  The environment to use.
     * @param  string|null  $certPath  Optional certificate path.
     * @param  string|null  $certPassword  Optional certificate password.
     * @return string Valid authentication token (Bearer).
     *
     * @throws ConnectionException|RequestException
     */
    public function handle(?string $env = null, ?string $certPath = null, ?string $certPassword = null): string
    {
        $cacheKey = config('dgii.cache.prefix').md5($certPath.$env);

        if ($token = Cache::get($cacheKey)) {
            return $token;
        }

        $response = $this->refreshToken($env, $certPath, $certPassword);

        $ttl = max(1, (strtotime($response['expira']) - now()->timestamp) - config('dgii.cache.buffer', 60));

        Cache::put($cacheKey, $response['token'], $ttl);

        return $response['token'];
    }
}
