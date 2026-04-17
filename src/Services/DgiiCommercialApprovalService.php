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

class DgiiCommercialApprovalService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected XmlSigner $xmlSigner,
        protected StorageService $storageService,
    ) {
        //
    }

    /**
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
