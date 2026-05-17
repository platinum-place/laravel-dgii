<?php

namespace PlatinumPlace\LaravelDgii\Actions\CancellationRanges\Orchestrators;

use Illuminate\Http\Client\ConnectionException;
use PlatinumPlace\LaravelDgii\Actions\Auth\Orchestrators\ResolveAccessToken;
use PlatinumPlace\LaravelDgii\Actions\CancellationRanges\Mappers\MapCancellationRangeXmlAction;
use PlatinumPlace\LaravelDgii\Actions\Xmls\Orchestrators\SignXmlAction;
use PlatinumPlace\LaravelDgii\Actions\Xmls\Orchestrators\ValidateCertificateAction;
use PlatinumPlace\LaravelDgii\Data\CancellationRange\CancellationRangeData;
use PlatinumPlace\LaravelDgii\Data\CancellationRange\CancellationRangeXml;
use PlatinumPlace\LaravelDgii\Exceptions\DgiiRepositoryException;
use PlatinumPlace\LaravelDgii\Repositories\CancellationRangeRepository;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;

class SubmitCancellationRangeAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected ValidateCertificateAction $validateCertificate,
        protected MapCancellationRangeXmlAction $mapper,
        protected SignXmlAction $signXml,
        protected StorageRepository $storage,
        protected ResolveAccessToken $accessToken,
        protected CancellationRangeRepository $repository,
    ) {
        //
    }


    public function handle(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): CancellationRangeData
    {
        $this->validateCertificate->handle($certPath, $certPassword);

        $xml = $this->mapper->handle($data);

        $signed = $this->signXml->handle($xml, $certPath, $certPassword);

        $object = new CancellationRangeXml($signed);

        $path = $this->storage->save($signed);

        $filePath = $this->storage->realPath($path);

        $token = $this->accessToken->handle($env, $certPath, $certPassword);

        $response = $this->repository->sendCancellationRange($token, $filePath, $env);

        return new CancellationRangeData($object, $path, $response);
    }
}
