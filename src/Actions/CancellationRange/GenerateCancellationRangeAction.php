<?php

namespace PlatinumPlace\LaravelDgii\Actions\CancellationRange;

use Illuminate\Support\Facades\View;

class GenerateCancellationRangeAction
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function handle(array $data): string
    {
        return View::make('dgii::anecf.xml', $data)->render();
    }
}
