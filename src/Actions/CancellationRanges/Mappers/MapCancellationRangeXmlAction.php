<?php

namespace PlatinumPlace\LaravelDgii\Actions\CancellationRanges\Mappers;

use Illuminate\Support\Facades\View;

/**
 * Generates the raw XML string for a range cancellation (ANECF).
 */
class MapCancellationRangeXmlAction
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Render the ANECF XML template using Blade.
     */
    public function handle(array $data): string
    {
        return View::make('dgii::anecf.xml', $data)->render();
    }
}
