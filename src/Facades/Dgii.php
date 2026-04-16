<?php

namespace PlatinumPlace\LaravelDgii\Facades;

use PlatinumPlace\LaravelDgii\Data\InvoiceData;
use PlatinumPlace\LaravelDgii\Supports\DgiiSupport;
use PlatinumPlace\LaravelDgii\ValueObjects\InvoiceXml;
use Illuminate\Support\Facades\Facade;

class Dgii extends Facade
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    protected static function getFacadeAccessor(): string
    {
        return DgiiSupport::class;
    }
}