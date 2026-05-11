<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use PlatinumPlace\LaravelDgii\Repositories\DgiiRepository;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;

/**
 * Class ReceiveSeedAction
 *
 * This action handles the reception of a signed seed XML, stores it in the
 * local repository, and exchanges it for a security token from the DGII.
 */
class ReceiveSeedAction
{
    /**
     * Create a new receive seed action instance.
     *
     * @param  StorageRepository  $storage  Repository to handle local storage of the seed XML.
     * @param  DgiiRepository  $repository  Repository to handle the token exchange with DGII.
     */
    public function __construct(
        protected StorageRepository $storage,
        protected DgiiRepository $repository,
    ) {
        //
    }

    /**
     * Handle the seed reception and token exchange.
     *
     * @param  string  $xml  The signed seed XML content.
     * @param  string|null  $env  Target environment.
     * @return array The authentication token response.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function handle(string $xml, ?string $env = null): array
    {
        $path = $this->storage->save($xml);

        $filePath = $this->storage->realPath($path);

        return $this->repository->getToken($filePath, $env);
    }
}
