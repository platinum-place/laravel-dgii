<?php

namespace PlatinumPlace\LaravelDgii\Actions\Auth\Orchestrators;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Cache;
use PlatinumPlace\LaravelDgii\Actions\Xmls\Orchestrators\SignXmlAction;
use PlatinumPlace\LaravelDgii\Exceptions\DgiiRepositoryException;
use PlatinumPlace\LaravelDgii\Repositories\SeedRepository;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;

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
