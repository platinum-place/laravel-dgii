<?php

namespace PlatinumPlace\LaravelDgii\Services;

use Illuminate\Support\Facades\Cache;
use PlatinumPlace\LaravelDgii\Repositories\DgiiRepository;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;

/**
 * Service to handle authentication and token management with the DGII.
 *
 * This class manages the lifecycle of authentication tokens, including requesting
 * a seed, signing it, and exchanging it for a short-lived access token.
 */
class DgiiAuthenticator
{
    /**
     * Create a new service instance.
     *
     * @param  DgiiRepository  $repository  The repository to communicate with DGII services.
     * @param  XmlSigner  $xmlSigner  Service to digitally sign the security seed.
     * @param  StorageRepository  $storage  Service to temporarily store the signed seed.
     */
    public function __construct(
        protected DgiiRepository $repository,
        protected XmlSigner $xmlSigner,
        protected StorageRepository $storage,
    ) {
        //
    }

    /**
     * Retrieve a valid authentication token from cache or DGII.
     *
     * Flow: Check Cache -> If not found: [Request Seed -> Sign Seed -> Save Signed Seed -> Request Token -> Store in Cache] -> Return Token.
     *
     * @param  string|null  $env  Target environment.
     * @param  string|null  $certPath  Custom path to the certificate.
     * @param  string|null  $certPassword  Certificate password.
     * @return string The active Bearer authentication token.
     */
    public function getToken(?string $env = null, ?string $certPath = null, ?string $certPassword = null): string
    {
        $cacheKey = config('dgii.cache.prefix').md5($certPath.$env);
        $ttl = max(1, 3600 - config('dgii.cache.buffer', 60));

        return Cache::remember($cacheKey, $ttl, function () use ($env, $certPath, $certPassword) {
            $xml = $this->repository->getSeed($env);

            $signed = $this->xmlSigner->sign($xml, $certPath, $certPassword);

            $path = $this->storage->save($signed, now()->timestamp.'-semilla');

            $realPath = $this->storage->realPath($path);

            return $this->repository->getToken($realPath, $env)['token'];
        });
    }
}
