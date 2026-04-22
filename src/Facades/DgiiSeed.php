<?php

namespace PlatinumPlace\LaravelDgii\Facades;

use Illuminate\Support\Facades\Facade;
use PlatinumPlace\LaravelDgii\Services\DgiiSeedService;

/**
 * @method static string requestXml(?string $env = null)
 * @method static array requestToken(string $signedXml, ?string $env = null)
 *
 * @see DgiiSeedService
 */
class DgiiSeed extends Facade
{
    protected static function getFacadeAccessor()
    {
        return DgiiSeedService::class;
    }
}
