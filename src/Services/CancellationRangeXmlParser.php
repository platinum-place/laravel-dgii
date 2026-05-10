<?php

namespace PlatinumPlace\LaravelDgii\Services;

use Illuminate\Support\Facades\View;

class CancellationRangeXmlParser
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
    public function make(array $data): string
    {
        return View::make('dgii::anecf.xml', $data)->render();
    }
}
