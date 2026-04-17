<?php

namespace PlatinumPlace\LaravelDgii\Actions\CancellationRange;

use Illuminate\Support\Facades\View;

/**
 * Action to generate the Sequence Range Cancellation (ANECF) XML content.
 */
class GenerateCancellationRangeAction
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Generate the ANECF XML content from data and template.
     *
     * @param  array  $data  Template data for cancellation.
     * @return string The rendered XML content.
     */
    public function handle(array $data): string
    {
        return View::make('dgii::anecf.xml', $data)->render();
    }
}
