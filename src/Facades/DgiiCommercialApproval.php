<?php

namespace PlatinumPlace\LaravelDgii\Facades;

use Illuminate\Support\Facades\Facade;
use PlatinumPlace\LaravelDgii\Services\DgiiCommercialApprovalService;
use PlatinumPlace\LaravelDgii\Services\DgiiService;

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
