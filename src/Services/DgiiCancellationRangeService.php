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
use PlatinumPlace\LaravelDgii\Data\CancellationRangeData;

/**
 * Service to manage e-CF Sequence Range Cancellations (ANECF).
 */
class DgiiCancellationRangeService
{
    /**
     * Create a new service instance.
     */
    public function __construct()
    {
        //
    }

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
        app(ValidateCertAction::class)->handle($certPath, $certPassword);

        $cancellationRangeXmlContent = app(GenerateCancellationRangeAction::class)->handle($data);

        $cancellationRangeXml = app(SignCancellationRangeAction::class)->handle($cancellationRangeXmlContent, $certPath, $certPassword);

        $cancellationRangeXmlPath = app(StorageCancellationRangeAction::class)->handle($cancellationRangeXml->xmlContent);

        $cancellationRangeReceived = app(SendCancellationRangeAction::class)->handle($cancellationRangeXmlPath, $env, $certPath, $certPassword);

        return new CancellationRangeData($cancellationRangeXml, $cancellationRangeXmlPath, $cancellationRangeReceived);
    }
}
