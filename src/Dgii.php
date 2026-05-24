<?php

namespace PlatinumPlace\LaravelDgii;

use Illuminate\Support\Facades\Facade;

class Dgii extends Facade
{
    protected static function getFacadeAccessor()
    {
        return DgiiService::class;
    }
}
