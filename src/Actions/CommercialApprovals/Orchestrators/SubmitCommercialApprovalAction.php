<?php

namespace PlatinumPlace\LaravelDgii\Actions\CommercialApprovals\Orchestrators;

use Illuminate\Http\Client\ConnectionException;
use PlatinumPlace\LaravelDgii\Actions\Xmls\Orchestrators\ValidateCertificateAction;
use PlatinumPlace\LaravelDgii\Data\CommercialApproval\CommercialApprovalData;
use PlatinumPlace\LaravelDgii\Data\CommercialApproval\CommercialApprovalXml;
use PlatinumPlace\LaravelDgii\Exceptions\DgiiRepositoryException;
use PlatinumPlace\LaravelDgii\Repositories\CommercialApprovalRepository;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;

class SubmitCommercialApprovalAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected ValidateCertificateAction $validateCertificate,
        protected StorageRepository $storage,
        protected CommercialApprovalRepository $repository,
    ) {
        //
    }

    public function handle(string $token, string $signed, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): CommercialApprovalData
    {
        $this->validateCertificate->handle($certPath, $certPassword);

        $object = new CommercialApprovalXml($signed);

        $path = $this->storage->save($signed, $object->getXmlName());

        $filePath = $this->storage->realPath($path);

        $response = $this->repository->sendCommercialApproval($token, $filePath, $env);

        return new CommercialApprovalData($object, $path, $response);
    }
}
