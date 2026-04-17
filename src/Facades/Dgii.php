<?php

namespace PlatinumPlace\LaravelDgii\Facades;

use Illuminate\Support\Facades\Facade;
use PlatinumPlace\LaravelDgii\Services\DgiiService;

/**
 * @method static array getServiceStatus()
 * @method static array getMaintenanceWindows()
 * @method static array getEnvironmentStatus(?string $env = null)
 *
 * @see DgiiService
 */
class Dgii extends Facade
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
        return DgiiService::class;
    }
}
