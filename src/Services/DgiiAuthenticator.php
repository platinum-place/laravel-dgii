<?php

namespace PlatinumPlace\LaravelDgii\Services;

use Illuminate\Support\Facades\Cache;
use PlatinumPlace\LaravelDgii\Repositories\DgiiServiceRepository;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;

class DgiiAuthenticator
{
    /**
     * Create a new service instance.
     */
    public function __construct(
        protected DgiiServiceRepository $serviceRepository,
        protected XmlSigner $xmlSigner,
        protected StorageRepository $storage,
    ) {
        //
    }

    public function getToken(?string $env = null, ?string $certPath = null, ?string $certPassword = null): string
    {
        $cacheKey = config('dgii.cache.prefix').md5($certPath.$env);
        $ttl = max(1, 3600 - config('dgii.cache.buffer', 60));

        return Cache::remember($cacheKey, $ttl, function () use ($env, $certPath, $certPassword) {
            $xml = $this->serviceRepository->getSeed($env);

            $signed = $this->xmlSigner->sign($xml, $certPath, $certPassword);

            $path = $this->storage->save($signed, now()->timestamp.'-semilla');

            $realPath = $this->storage->realPath($path);

            return $this->serviceRepository->getToken($realPath, $env)['access_token'];
        });
    }
}
