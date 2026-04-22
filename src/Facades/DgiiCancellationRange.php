<?php

namespace PlatinumPlace\LaravelDgii\Facades;

use Illuminate\Support\Facades\Facade;
use PlatinumPlace\LaravelDgii\Services\DgiiCancellationRangeService;

/**
 * @method static \PlatinumPlace\LaravelDgii\Data\CancellationRange\CancellationRangeData send(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null)
 *
 * @see DgiiCancellationRangeService
 */
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
