<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Ambiente DGII
    |--------------------------------------------------------------------------
    |
    | El ambiente de la DGII a utilizar. Los valores posibles son:
    | - testecf (pruebas)
    | - certecf (certificación)
    | - ecf (producción)
    |
    */

    'environment' => env('DGII_ENVIRONMENT', 'testecf'),

    /*
    |--------------------------------------------------------------------------
    | API Key
    |--------------------------------------------------------------------------
    |
    | API Key proporcionada por la DGII para consultas de estatus de servicios.
    |
    */

    'api_key' => env('DGII_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Dominios
    |--------------------------------------------------------------------------
    |
    | URLs base de los servicios de la DGII.
    |
    */

    'domains' => [
        'ecf' => env('DGII_DOMAIN_ECF', 'https://ecf.dgii.gov.do'),
        'fc' => env('DGII_DOMAIN_FC', 'https://fc.dgii.gov.do'),
        'statusecf' => env('DGII_DOMAIN_STATUS', 'https://statusecf.dgii.gov.do'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Reglas de Validación
    |--------------------------------------------------------------------------
    |
    | Reglas y límites impuestos por la DGII.
    |
    */

    'rules' => [
        'fc_type' => (int)env('DGII_FC_TYPE', 32),
        'fc_limit' => (int)env('DGII_FC_LIMIT', 250000),
    ],

];
