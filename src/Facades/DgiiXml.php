<?php

namespace PlatinumPlace\LaravelDgii\Facades;

use Illuminate\Support\Facades\Facade;
use PlatinumPlace\LaravelDgii\Services\XmlService;

/**
 * @method static string sign(string $xml, ?string $certPath = null, ?string $certPassword = null)
 * @method static array validateCertificate(?string $certPath = null, ?string $certPassword = null)
 *
 * @see XmlService
 */
class DgiiXml extends Facade
{
    protected static function getFacadeAccessor()
    {
        return XmlService::class;
    }
}
