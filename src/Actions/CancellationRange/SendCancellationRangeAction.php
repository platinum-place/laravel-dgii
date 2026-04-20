<?php

namespace PlatinumPlace\LaravelDgii\Actions\CancellationRange;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use PlatinumPlace\LaravelDgii\Actions\AuthenticateAction;
use PlatinumPlace\LaravelDgii\Clients\CancellationRangeClient;
use PlatinumPlace\LaravelDgii\Traits\HasResponse;

/**
 * Action to send a signed Cancellation Range (ANECF) XML to DGII.
 */
class SendCancellationRangeAction
{
    use HasResponse;

    /**
     * Create a new class instance.
     *
     * @param  AuthenticateAction  $authenticateAction  Authentication service.
     * @param  CancellationRangeClient  $cancellationRangeClient  Cancellation client.
     */
    public function __construct(
        protected AuthenticateAction $authenticateAction,
        protected CancellationRangeClient $cancellationRangeClient
    ) {
        //
    }

    /**
     * Send the signed Cancellation Range XML to DGII.
     *
     * @param  string  $xmlPath  Relative path of the signed XML file.
     * @param  string|null  $env  The environment to use.
     * @param  string|null  $certPath  Optional certificate path.
     * @param  string|null  $certPassword  Optional certificate password.
     * @return array DGII response.
     *
     * @throws ConnectionException|RequestException
     */
    public function handle(string $xmlPath, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): array
    {
        return $this->catchResponse(function () use ($xmlPath, $env, $certPath, $certPassword) {
            $token = $this->authenticateAction->handle($env, $certPath, $certPassword);

            return $this->cancellationRangeClient->send($token, $xmlPath, $env);
        });
    }
}
