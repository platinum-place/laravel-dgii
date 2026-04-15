<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use PlatinumPlace\LaravelDgii\Clients\DgiiClient;

class SendCommercialApprovalAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected AuthenticateAction $authenticateAction, protected DgiiClient $client)
    {
        //
    }

    /**
     * @throws ConnectionException
     * @throws RequestException
     */
    public function handle(string $xmlPath, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): array
    {
        $token = $this->authenticateAction->handle($env, $certPath, $certPassword);

        return $this->client->sendCommercialApproval($token, $xmlPath, $env);
    }
}
