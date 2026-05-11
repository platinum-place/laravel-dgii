<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use PlatinumPlace\LaravelDgii\Data\CommercialApproval\CommercialApprovalData;
use PlatinumPlace\LaravelDgii\Data\CommercialApproval\CommercialApprovalXml;
use PlatinumPlace\LaravelDgii\Repositories\DgiiCommercialApprovalRepository;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;
use PlatinumPlace\LaravelDgii\Services\XmlSigner;

/**
 * Class SubmitCommercialApprovalAction
 *
 * This action handles the submission of a Commercial Approval (Aprobación Comercial)
 * document to the DGII. This document is typically used by the buyer to
 * approve or reject a received electronic invoice.
 */
class SubmitCommercialApprovalAction
{
    /**
     * Create a new submit commercial approval action instance.
     */
    public function __construct(
        protected XmlSigner $xmlSigner,
        protected StorageRepository $storage,
        protected DgiiCommercialApprovalRepository $repository,
    ) {
        //
    }

    /**
     * Handle the commercial approval submission.
     *
     * Execution Flow:
     * 1. Validate: Ensure the digital certificate is valid.
     * 2. Store: Save the signed commercial approval XML string to storage.
     * 3. Submit: Send the signed XML file to the DGII commercial approval endpoint using the provided token.
     *
     * @param  string  $token  The security token from DGII.
     * @param  string  $signed  The signed XML content.
     * @param  string|null  $env  The target environment.
     * @param  string|null  $certPath  Path to the certificate file.
     * @param  string|null  $certPassword  Password for the certificate.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function handle(string $token, string $signed, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): CommercialApprovalData
    {
        $this->xmlSigner->validateCertificate($certPath, $certPassword);

        $object = new CommercialApprovalXml($signed);

        $path = $this->storage->save($signed,$object->getXmlName());

        $filePath = $this->storage->realPath($path);

        $response = $this->repository->send($token, $filePath, $env);

        return new CommercialApprovalData($object, $path, $response);
    }
}
