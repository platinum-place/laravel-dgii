<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use PlatinumPlace\LaravelDgii\Clients\DgiiClient;
use PlatinumPlace\LaravelDgii\Helpers\StorageHelper;

class ReceiveSeedAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected DgiiClient $client, protected StorageHelper $storageHelper)
    {
        //
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function handle(string $signedXml, ?string $env = null): array
    {
        $xmlPath = $this->storageHelper->putXml($signedXml);

        return $this->client->fetchToken($xmlPath, $env);
    }
}
