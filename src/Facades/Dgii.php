<?php

namespace PlatinumPlace\LaravelDgii\Facades;

use Illuminate\Support\Facades\Facade;
use PlatinumPlace\LaravelDgii\Services\DgiiService;

class Dgii extends Facade
{
    protected static function getFacadeAccessor()
    {
        return DgiiService::class;
    }
}
