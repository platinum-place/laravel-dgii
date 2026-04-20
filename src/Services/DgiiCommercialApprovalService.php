<?php

namespace PlatinumPlace\LaravelDgii\Services;

use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use PlatinumPlace\LaravelDgii\Actions\CommercialApproval\SendCommercialApprovalAction;
use PlatinumPlace\LaravelDgii\Actions\CommercialApproval\StorageCommercialApprovalAction;
use PlatinumPlace\LaravelDgii\Data\CommercialApprovalData;
use PlatinumPlace\LaravelDgii\ValueObjects\CommercialApproval\CommercialApprovalXml;

/**
 * Service to manage Commercial Approvals (ARECF).
 */
class DgiiCommercialApprovalService
{
    /**
     * Create a new service instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the commercial approval (ARECF) process for a received e-CF.
     *
     * @param  string  $xmlContent  Signed XML content of the approval document.
     * @param  string|null  $env  The environment to use.
     * @param  string|null  $certPath  Optional certificate path for authentication.
     * @param  string|null  $certPassword  Optional certificate password.
     * @param  string|null  $token  Optional existing authentication token.
     * @return CommercialApprovalData The data object containing XML, path, and DGII response.
     *
     * @throws ConnectionException|RequestException|Exception
     */
    public function send(string $xmlContent, ?string $env = null, ?string $certPath = null, ?string $certPassword = null, ?string $token = null): CommercialApprovalData
    {
        $commercialApprovalXml = new CommercialApprovalXml($xmlContent);

        $commercialApprovalXmlPath = app(StorageCommercialApprovalAction::class)->handle($commercialApprovalXml);

        $response = app(SendCommercialApprovalAction::class)->handle($commercialApprovalXmlPath, $env, $certPath, $certPassword, $token);

        return new CommercialApprovalData($commercialApprovalXml, $commercialApprovalXmlPath, $response);
    }
}
