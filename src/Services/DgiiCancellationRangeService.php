<?php

namespace PlatinumPlace\LaravelDgii\Services;

use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use PlatinumPlace\LaravelDgii\Actions\CancellationRange\GenerateCancellationRangeAction;
use PlatinumPlace\LaravelDgii\Actions\CancellationRange\SendCancellationRangeAction;
use PlatinumPlace\LaravelDgii\Actions\CancellationRange\SignCancellationRangeAction;
use PlatinumPlace\LaravelDgii\Actions\CancellationRange\StorageCancellationRangeAction;
use PlatinumPlace\LaravelDgii\Actions\ValidateCertAction;
use PlatinumPlace\LaravelDgii\Data\CancellationRange\CancellationRangeData;

/**
 * Service to manage e-CF Sequence Range Cancellations (ANECF).
 */
class DgiiCancellationRangeService
{
    /**
     * Create a new service instance.
     */
    public function __construct(
        protected ValidateCertAction $validateCertAction,
        protected GenerateCancellationRangeAction $generateCancellationRangeAction,
        protected SignCancellationRangeAction $signCancellationRangeAction,
        protected StorageCancellationRangeAction $storageCancellationRangeAction,
        protected SendCancellationRangeAction $sendCancellationRangeAction
    ) {}

    /**
     * Generate, sign, store, and send a sequence range cancellation (ANECF) request to DGII.
     *
     * @param  array  $data  Template data for the cancellation request.
     * @param  string|null  $env  The environment to use.
     * @param  string|null  $certPath  Optional certificate path.
     * @param  string|null  $certPassword  Optional certificate password.
     * @return CancellationRangeData The data object containing XMLs, path, and DGII response.
     *
     * @throws ConnectionException|RequestException|Exception
     */
    public function send(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): CancellationRangeData
    {
        $this->validateCertAction->handle($certPath, $certPassword);

        $cancellationRangeXmlContent = $this->generateCancellationRangeAction->handle($data);

        $cancellationRangeXml = $this->signCancellationRangeAction->handle($cancellationRangeXmlContent, $certPath, $certPassword);

        $cancellationRangeXmlPath = $this->storageCancellationRangeAction->handle($cancellationRangeXml->xmlContent);

        $cancellationRangeReceived = $this->sendCancellationRangeAction->handle($cancellationRangeXmlPath, $env, $certPath, $certPassword);

        return new CancellationRangeData($cancellationRangeXml, $cancellationRangeXmlPath, $cancellationRangeReceived);
    }
}
