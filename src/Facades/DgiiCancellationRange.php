<?php

namespace PlatinumPlace\LaravelDgii\Facades;

use Illuminate\Support\Facades\Facade;
use PlatinumPlace\LaravelDgii\Services\DgiiCancellationRangeService;

class DgiiCancellationRange extends Facade
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
        return DgiiCancellationRangeService::class;
    }
}
