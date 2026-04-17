<?php

namespace PlatinumPlace\LaravelDgii\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use PlatinumPlace\LaravelDgii\Actions\Seed\ReceiveSeedAction;
use PlatinumPlace\LaravelDgii\Clients\SeedClient;
use PlatinumPlace\LaravelDgii\Support\StorageService;

/**
 * Service to manage DGII Authentication Seeds.
 */
class DgiiSeedService
{
    /**
     * Create a new service instance.
     */
    public function __construct( ) {
        //
    }

    /**
     * Request a new authentication seed XML from DGII.
     *
     * @param  string|null  $env  The environment to use.
     * @return string Raw seed XML content.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function requestXml(?string $env = null): string
    {
        return app(SeedClient::class)->fetch($env);
    }

    /**
     * Validate a signed seed and request an access token.
     *
     * @param  string  $signedXml  Signed seed XML content.
     * @param  string|null  $env  The environment to use.
     * @return array Response data containing the token and expiration.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function requestToken(string $signedXml, ?string $env = null): array
    {
        return app(ReceiveSeedAction::class)->handle($signedXml, $env);
    }
}
