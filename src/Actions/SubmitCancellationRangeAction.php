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

class SubmitCancellationRangeAction
{
    /**
     * Create a new validate certificate action instance.
     */
    public function __construct(
        protected ValidateCertAction $validateCert,
        protected CancellationRangeXmlParser $xmlParser,
        protected XmlSigner $xmlSigner,
        protected StorageRepository $storage,
        protected DgiiAuthenticator $authenticator,
        protected DgiiCancellationRangeRepository $repository,
    ) {
        //
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function handle(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): CancellationRangeData
    {
        $this->validateCert->handle($certPath, $certPassword);

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
