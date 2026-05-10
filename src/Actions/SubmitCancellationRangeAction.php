<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use PlatinumPlace\LaravelDgii\Data\CancellationRange\CancellationRangeData;
use PlatinumPlace\LaravelDgii\Data\CancellationRange\CancellationRangeXml;
use PlatinumPlace\LaravelDgii\Repositories\DgiiCancellationRangeRepository;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;
use PlatinumPlace\LaravelDgii\Services\CancellationRangeXmlParser;
use PlatinumPlace\LaravelDgii\Services\DgiiAuthenticator;
use PlatinumPlace\LaravelDgii\Services\XmlSigner;

/**
 * Class SubmitCancellationRangeAction
 *
 * This action handles the process of canceling a range of NCFs. It involves
 * parsing the data into the specific DGII XML format, signing it,
 * authenticating, and submitting it to the DGII web services.
 */
class SubmitCancellationRangeAction
{
    /**
     * Create a new submit cancellation range action instance.
     */
    public function __construct(
        protected XmlSigner $xmlSigner,
        protected CancellationRangeXmlParser $xmlParser,
        protected StorageRepository $storage,
        protected DgiiAuthenticator $authenticator,
        protected DgiiCancellationRangeRepository $repository,
    ) {
        //
    }

    /**
     * Handle the cancellation range submission.
     *
     * Execution Flow:
     * 1. Validate: Ensure the digital certificate is valid.
     * 2. Parse: Generate the Cancellation Range XML from the input data.
     * 3. Sign & Store: Sign the XML and save it to storage.
     * 4. Authenticate: Obtain a security token from DGII.
     * 5. Submit: Send the signed XML file to the DGII cancellation endpoint.
     *
     * @throws RequestException
     * @throws ConnectionException
     */
    public function handle(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): CancellationRangeData
    {
        $this->xmlSigner->validateCertificate($certPath, $certPassword);

        $xml = $this->xmlParser->make($data);

        $signed = $this->xmlSigner->sign($xml, $certPath, $certPassword);

        $object = new CancellationRangeXml($signed);

        $path = $this->storage->save($signed);

        $filePath = $this->storage->realPath($path);

        $token = $this->authenticator->getToken($env, $certPath, $certPassword);

        $response = $this->repository->send($token, $filePath, $env);

        return new CancellationRangeData($object, $path, $response);
    }
}
