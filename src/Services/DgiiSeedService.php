<?php

namespace PlatinumPlace\LaravelDgii\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use PlatinumPlace\LaravelDgii\Actions\Seed\ReceiveSeedAction;
use PlatinumPlace\LaravelDgii\Clients\SeedClient;

/**
 * Service to manage DGII Authentication Seeds.
 */
class DgiiSeedService
{
    /**
     * Create a new service instance.
     */
    public function __construct(
        protected SeedClient $seedClient,
        protected ReceiveSeedAction $receiveSeedAction
    ) {}

    /**
     * Request a new authentication seed XML from DGII to begin login.
     *
     * @param  string|null  $env  The environment to use (e.g., 'testecf').
     * @return string Raw seed XML content string.
     *
     * @throws ConnectionException|RequestException
     */
    public function requestXml(?string $env = null): string
    {
        return $this->seedClient->fetch($env);
    }

    /**
     * Validate a signed seed XML with DGII and request an access token.
     *
     * @param  string  $signedXml  The signed seed XML content.
     * @param  string|null  $env  The environment to use.
     * @return array Response array containing 'token' and 'expira' (expiration).
     *
     * @throws ConnectionException|RequestException
     */
    public function requestToken(string $signedXml, ?string $env = null): array
    {
        return $this->receiveSeedAction->handle($signedXml, $env);
    }
}
