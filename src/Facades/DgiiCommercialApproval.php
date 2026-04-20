<?php

namespace PlatinumPlace\LaravelDgii\Facades;

use Illuminate\Support\Facades\Facade;
use PlatinumPlace\LaravelDgii\Services\DgiiCommercialApprovalService;

/**
 * @method static \PlatinumPlace\LaravelDgii\Data\CommercialApprovalData send(string $xmlContent, ?string $env = null, ?string $certPath = null, ?string $certPassword = null, ?string $token = null)
 *
 * @see DgiiCommercialApprovalService
 */
class DgiiCommercialApproval extends Facade
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
        return DgiiCommercialApprovalService::class;
    }
}
