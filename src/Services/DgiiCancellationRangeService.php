<?php

namespace PlatinumPlace\LaravelDgii\Services;

use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use PlatinumPlace\LaravelDgii\Actions\CancellationRange\GenerateCancellationRangeAction;
use PlatinumPlace\LaravelDgii\Actions\CancellationRange\SignCancellationRangeAction;
use PlatinumPlace\LaravelDgii\Actions\CancellationRange\StorageCancellationRangeAction;
use PlatinumPlace\LaravelDgii\Actions\CommercialApproval\SendCommercialApprovalAction;
use PlatinumPlace\LaravelDgii\ValueObjects\CancellationRange\CancellationRangeReceived;

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
     * Generate, sign, store, and send a range cancellation request to DGII.
     *
     * @param  array  $data  Template data for the cancellation.
     * @param  string|null  $env  The environment to use.
     * @param  string|null  $certPath  Optional certificate path.
     * @param  string|null  $certPassword  Optional certificate password.
     * @return CancellationRangeReceived The final result of the operation.
     *
     * @throws RequestException
     * @throws ConnectionException
     * @throws Exception
     */
    public function send(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): CancellationRangeReceived
    {
        $cancellationRangeXmlContent = app(GenerateCancellationRangeAction::class)->handle($data);

        $cancellationRangeXml = app(SignCancellationRangeAction::class)->handle($cancellationRangeXmlContent, $certPath, $certPassword);

        $storedCancellationRange = app(StorageCancellationRangeAction::class)->handle($cancellationRangeXml);

        $response = app(SendCommercialApprovalAction::class)->handle($storedCancellationRange->cancellationRangeXmlPath, $env, $certPath, $certPassword);

        return new CancellationRangeReceived($storedCancellationRange, $response);
    }
}
