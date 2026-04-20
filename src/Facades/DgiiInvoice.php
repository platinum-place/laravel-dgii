<?php

namespace PlatinumPlace\LaravelDgii\Facades;

use Illuminate\Support\Facades\Facade;
use PlatinumPlace\LaravelDgii\Services\DgiiInvoiceService;

/**
 * @method static string getQrlInk(string $xmlPath, ?string $env = null)
 * @method static \PlatinumPlace\LaravelDgii\Data\InvoiceData storage(string $xmlContent, ?string $env = null, ?string $integralXmlContent = null)
 * @method static \PlatinumPlace\LaravelDgii\Data\InvoiceData sign(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null)
 * @method static \PlatinumPlace\LaravelDgii\Data\InvoiceData send(string|array $xmlContent, ?string $env = null, ?string $certPath = null, ?string $certPassword = null, ?string $token = null)
 * @method static \PlatinumPlace\LaravelDgii\Data\InvoiceData checkStatus(string $xmlPath, ?string $trackId = null, ?string $env = null, ?string $certPath = null, ?string $certPassword = null)
 * @method static string generatePdf(string $xmlContent, string $qrLink, ?string $logo = null)
 * @method static \PlatinumPlace\LaravelDgii\Data\InvoiceData submit(string $xmlPath, ?string $env = null, ?string $certPath = null, ?string $certPassword = null)
 *
 * @see DgiiInvoiceService
 */
class DgiiInvoice extends Facade
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    protected static function getFacadeAccessor()
    {
        return DgiiInvoiceService::class;
    }
}
