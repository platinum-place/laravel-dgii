<?php

namespace PlatinumPlace\LaravelDgii\Services;

use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use PlatinumPlace\LaravelDgii\Actions\CommercialApproval\SendCommercialApprovalAction;
use PlatinumPlace\LaravelDgii\Actions\CommercialApproval\StorageCommercialApprovalAction;
use PlatinumPlace\LaravelDgii\Support\StorageService;
use PlatinumPlace\LaravelDgii\Support\XmlSigner;
use PlatinumPlace\LaravelDgii\ValueObjects\CommercialApproval\CommercialApprovalReceived;
use PlatinumPlace\LaravelDgii\ValueObjects\CommercialApproval\CommercialApprovalXml;

/**
 * Service to manage Commercial Approvals (ARECF).
 */
class DgiiCommercialApprovalService
{
    /**
     * Create a new service instance.
     *
     * @param  XmlSigner  $xmlSigner  XML signing service.
     * @param  StorageService  $storageService  Storage service.
     */
    public function __construct(
        protected XmlSigner $xmlSigner,
        protected StorageService $storageService,
    ) {
        //
    }

    /**
     * Handle the commercial approval process for a received e-CF.
     *
     * @param  string  $xmlContent  Signed XML content of the approval.
     * @param  string|null  $env  The environment to use.
     * @param  string|null  $certPath  Optional certificate path.
     * @param  string|null  $certPassword  Optional certificate password.
     * @param  string|null  $token  Optional existing authentication token.
     * @return CommercialApprovalReceived The final result of the operation.
     *
     * @throws RequestException
     * @throws ConnectionException
     * @throws Exception
     */
    public function send(string $xmlContent, ?string $env = null, ?string $certPath = null, ?string $certPassword = null, ?string $token = null): CommercialApprovalReceived
    {
        $commercialApprovalXml = new CommercialApprovalXml($xmlContent);

        $storedCommercialApproval = app(StorageCommercialApprovalAction::class)->handle($commercialApprovalXml);

        $response = app(SendCommercialApprovalAction::class)->handle($storedCommercialApproval->commercialApprovalXmlPath, $env, $certPath, $certPassword, $token);

        return new CommercialApprovalReceived($storedCommercialApproval, $response);
    }
}
