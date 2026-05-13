<?php

namespace PlatinumPlace\LaravelDgii\Actions\Auth\Orchestrators;

use Illuminate\Support\Facades\Cache;
use PlatinumPlace\LaravelDgii\Actions\Xmls\Orchestrators\SignXmlAction;
use PlatinumPlace\LaravelDgii\Repositories\SeedRepository;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;

/**
 * Resolves a valid access token for the DGII API.
 */
class ResolveAccessToken
{
    /**
     * Create a new service instance.
     */
    public function __construct(
        protected SeedRepository $repository,
        protected SignXmlAction $signXml,
        protected StorageRepository $storage,
    ) {
        //
    }

    /**
     * Get a valid token from cache or retrieve a new one from the DGII.
     *
     * Flow:
     * 1. Calculate cache key and TTL.
     * 2. Check cache for an existing token.
     * 3. If not in cache, request a new seed from the repository.
     * 4. Sign the seed XML with the digital certificate.
     * 5. Save the signed seed to storage.
     * 6. Exchange the signed seed for an access token via the repository.
     */
    public function handle(?string $env = null, ?string $certPath = null, ?string $certPassword = null): string
    {
        $cacheKey = config('dgii.cache.prefix').md5($certPath.$env);
        $ttl = max(1, 3600 - config('dgii.cache.buffer', 60));

        return Cache::remember($cacheKey, $ttl, function () use ($env, $certPath, $certPassword) {
            $xml = $this->repository->getSeed($env);

            $signed = $this->signXml->handle($xml, $certPath, $certPassword);

            $path = $this->storage->save($signed, now()->timestamp.'-semilla');

            $realPath = $this->storage->realPath($path);

            return $this->repository->getToken($realPath, $env)['token'];
        });
    }
}
