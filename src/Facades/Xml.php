<?php

namespace PlatinumPlace\LaravelDgii\Facades;

use Illuminate\Support\Facades\Facade;
use PlatinumPlace\LaravelDgii\Support\XmlSigner;

/**
 * @method static string sign(string $xml, ?string $certPath = null, ?string $certPassword = null)
 * @method static array validateCertificate(?string $certPath = null, ?string $certPassword = null)
 *
 * @see XmlSigner
 */
class Xml extends Facade
{
    protected static function getFacadeAccessor()
    {
        return XmlSigner::class;
    }
}
