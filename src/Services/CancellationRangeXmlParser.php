<?php

namespace PlatinumPlace\LaravelDgii\Services;

use Illuminate\Support\Facades\View;

/**
 * Service to generate Cancellation Range (ANECF) XML documents.
 *
 * This service handles the creation of the XML document required to notify the
 * DGII about the cancellation of a range of fiscal sequences (e-NCF).
 */
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
     * Generate the ANECF XML content from input data and template.
     *
     * Flow: Take structured data -> Map to Blade template -> Render to string -> Return XML.
     *
     * @param  array  $data  Template data containing RNC, sequence range, and reason.
     * @return string The rendered XML content.
     */
    public function make(array $data): string
    {
        return View::make('dgii::anecf.xml', $data)->render();
    }
}
