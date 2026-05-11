<?php

namespace PlatinumPlace\LaravelDgii\Facades;

use Illuminate\Support\Facades\Facade;
use PlatinumPlace\LaravelDgii\Services\DgiiService;

/**
 * @method static \PlatinumPlace\LaravelDgii\Data\CancellationRange\CancellationRangeData sendCancellationRange(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null)
 * @method static \PlatinumPlace\LaravelDgii\Data\CommercialApproval\CommercialApprovalData sendCommercialApproval(string $token, string $signed, ?string $env = null, ?string $certPath = null, ?string $certPassword = null)
 * @method static \PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceData submitInvoice(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null)
 * @method static \PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceData validateInvoiceStatus(string $path, ?string $trackId = null, ?string $env = null, ?string $certPath = null, ?string $certPassword = null)
 * @method static \PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceData sendInvoice(string $path, ?string $env = null, ?string $certPath = null, ?string $certPassword = null)
 * @method static \PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceData storageInvoice(string $signed, ?string $env = null)
 * @method static \PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceData signInvoice(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null)
 * @method static \PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceData receiveInvoice(string $token, string $signed, ?string $env = null, ?string $certPath = null, ?string $certPassword = null)
 * @method static array receiveSeed(string $xml, ?string $env = null)
 * @method static string requestSeed(?string $env = null)
 * @method static array requestToken(string $path, ?string $env = null)
 * @method static array getServiceStatus(?string $env = null)
 * @method static array getMaintenanceWindows(?string $env = null)
 * @method static array getEnvironmentStatus(?string $env = null)
 *
 * @see DgiiService
 */
class Dgii extends Facade
{
    protected static function getFacadeAccessor()
    {
        return DgiiService::class;
    }
}
