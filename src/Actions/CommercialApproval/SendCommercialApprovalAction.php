<?php

namespace PlatinumPlace\LaravelDgii\Actions\CommercialApproval;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use PlatinumPlace\LaravelDgii\Actions\AuthenticateAction;
use PlatinumPlace\LaravelDgii\Actions\WrapDgiiResponseAction;
use PlatinumPlace\LaravelDgii\Clients\CommercialApprovalClient;

/**
 * Action to send a signed Commercial Approval (ARECF) XML to DGII.
 */
class SendCommercialApprovalAction
{
    /**
     * Create a new class instance.
     *
     * @param  AuthenticateAction  $authenticateAction  Authentication service.
     * @param  CommercialApprovalClient  $commercialApprovalClient  Commercial approval client.
     */
    public function __construct(
        protected WrapDgiiResponseAction $wrapDgiiResponseAction,
        protected AuthenticateAction $authenticateAction,
        protected CommercialApprovalClient $commercialApprovalClient
    ) {
        //
    }

    /**
     * Send the signed Commercial Approval XML to DGII.
     *
     * @param  string  $xmlPath  Relative path of the signed XML file.
     * @param  string|null  $env  The environment to use.
     * @param  string|null  $certPath  Optional certificate path for authentication.
     * @param  string|null  $certPassword  Optional certificate password.
     * @param  string|null  $token  Optional existing authentication token.
     * @return array The raw DGII response array.
     *
     * @throws ConnectionException|RequestException
     */
    public function handle(string $xmlPath, ?string $env = null, ?string $certPath = null, ?string $certPassword = null, ?string $token = null): array
    {
        //        [$response] = $this->wrapDgiiResponseAction->handle(function () use ($xmlPath, $env, $certPath, $certPassword, $token) {
        if (! $token) {
            $token = $this->authenticateAction->handle($env, $certPath, $certPassword);
        }

        return $this->commercialApprovalClient->send($token, $xmlPath, $env);
        //        });
        //        return $response;
    }
}
