<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Cache;
use PlatinumPlace\LaravelDgii\Clients\DgiiClient;
use PlatinumPlace\LaravelDgii\Helpers\StorageHelper;
use PlatinumPlace\LaravelDgii\Services\SignXmlService;

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