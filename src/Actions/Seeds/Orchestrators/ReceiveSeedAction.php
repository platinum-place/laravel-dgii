<?php

namespace PlatinumPlace\LaravelDgii\Actions\Seeds\Orchestrators;

use PlatinumPlace\LaravelDgii\Repositories\SeedRepository;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;

/**
 * Orchestrates the reception of a seed from the DGII.
 */
class ReceiveSeedAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected StorageRepository $storage,
        protected SeedRepository $repository,
    ) {
        //
    }

    /**
     * Save the seed XML and retrieve the authentication token.
     *
     * Flow:
     * 1. Save the seed XML to storage.
     * 2. Retrieve the absolute path of the saved XML.
     * 3. Call the repository to exchange the seed path for a token.
     */
    public function handle(string $xml, ?string $env = null): array
    {
        $path = $this->storage->save($xml);

        $filePath = $this->storage->realPath($path);

        return $this->repository->getToken($filePath, $env);
    }
}
