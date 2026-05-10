<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use PlatinumPlace\LaravelDgii\Data\CommercialApproval\CommercialApprovalData;
use PlatinumPlace\LaravelDgii\Data\CommercialApproval\CommercialApprovalXml;
use PlatinumPlace\LaravelDgii\Repositories\DgiiCommercialApprovalRepository;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;
use PlatinumPlace\LaravelDgii\Services\DgiiAuthenticator;

class SubmitCommercialApprovalAction
{
    /**
     * Create a new validate certificate action instance.
     */
    public function __construct(
        protected ValidateCertAction $validateCert,
        protected StorageRepository $storage,
        protected DgiiAuthenticator $authenticator,
        protected DgiiCommercialApprovalRepository $repository,
    ) {
        //
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function handle(string $signed, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): CommercialApprovalData
    {
        $this->validateCert->handle($certPath, $certPassword);

        $object = new CommercialApprovalXml($signed);

        $path = $this->storage->save($signed);

        $filePath = $this->storage->realPath($path);

        $token = $this->authenticator->getToken($env, $certPath, $certPassword);

        $response = $this->repository->send($token, $filePath, $env);

        return new CommercialApprovalData($object, $path, $response);
    }
}
