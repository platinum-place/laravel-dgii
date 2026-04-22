<?php

namespace PlatinumPlace\LaravelDgii\Services;

use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use PlatinumPlace\LaravelDgii\Actions\CommercialApproval\SendCommercialApprovalAction;
use PlatinumPlace\LaravelDgii\Actions\CommercialApproval\StorageCommercialApprovalAction;
use PlatinumPlace\LaravelDgii\Actions\ValidateCertAction;
use PlatinumPlace\LaravelDgii\Data\CommercialApproval\CommercialApprovalData;
use PlatinumPlace\LaravelDgii\Data\CommercialApproval\CommercialApprovalXml;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;

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
     * @param  string  $token  Optional existing authentication token.
     * @param  string|null  $env  The environment to use.
     * @param  string|null  $certPath  Optional certificate path for authentication.
     * @param  string|null  $certPassword  Optional certificate password.
     * @return CommercialApprovalData The data object containing XML, path, and DGII response.
     *
     * @throws ConnectionException
     * @throws RequestException
     * @throws Exception
     */
    public function send(string $xmlContent, string $token, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): CommercialApprovalData
    {
        app(ValidateCertAction::class)->handle($certPath, $certPassword);

        $commercialApprovalXml = new CommercialApprovalXml($xmlContent);

        $commercialApprovalXmlPath = app(StorageCommercialApprovalAction::class)->handle($commercialApprovalXml);

        $filePath = app(StorageRepository::class)->realPath($commercialApprovalXmlPath);

        $response = app(SendCommercialApprovalAction::class)->handle($filePath, $env, $certPath, $certPassword, $token);

        return new CommercialApprovalData($commercialApprovalXml, $commercialApprovalXmlPath, $response);
    }
}
