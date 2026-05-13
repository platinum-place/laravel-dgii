<?php

namespace PlatinumPlace\LaravelDgii\Actions\CommercialApprovals\Orchestrators;

use PlatinumPlace\LaravelDgii\Actions\Xmls\Orchestrators\ValidateCertificateAction;
use PlatinumPlace\LaravelDgii\Data\CommercialApproval\CommercialApprovalData;
use PlatinumPlace\LaravelDgii\Data\CommercialApproval\CommercialApprovalXml;
use PlatinumPlace\LaravelDgii\Repositories\CommercialApprovalRepository;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;

/**
 * Orchestrates the submission of a commercial approval to the DGII.
 */
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

    /**
     * Store and submit a signed commercial approval XML to the DGII.
     *
     * Flow:
     * 1. Validate the digital certificate.
     * 2. Initialize the CommercialApprovalXml object from the signed string.
     * 3. Save the signed XML to the local storage.
     * 4. Call the repository to send the file to the DGII API.
     */
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
