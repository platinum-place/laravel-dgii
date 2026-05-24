<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Service Domains
    |--------------------------------------------------------------------------
    |
    | Base URLs for the different DGII services. The package handles
    | the final path construction based on the 'environment' setting.
    |
    */

    'domains' => [
        'invoice' => env('DGII_DOMAIN_INVOICE', 'https://ecf.dgii.gov.do'),
        'consumer_invoice' => env('DGII_DOMAIN_CONSUME_INVOICE', 'https://fc.dgii.gov.do'),
        'status' => env('DGII_DOMAIN_STATUS', 'https://statusecf.dgii.gov.do'),
    ],

    /*
    |--------------------------------------------------------------------------
    | DGII Endpoints
    |--------------------------------------------------------------------------
    |
    | Relative paths for the different DGII web services. These are combined
    | with domains and environments to form the final URLs.
    |
    */

    'endpoints' => [
        // Authentication & Seed Services (Domain: ecf)
        'auth' => [
            'seed' => 'autenticacion/api/autenticacion/semilla',
            'validate' => 'autenticacion/api/autenticacion/validarsemilla',
        ],

        // e-CF Reception & Query Services (Domain: ecf)
        'invoice' => [
            'send' => 'recepcion/api/facturaselectronicas',
            'status' => 'consultaresultado/api/consultas/estado',
            'list' => 'consultatrackids/api/trackids/consulta',
            'check' => 'consultaestado/api/consultas/estado',
            'qr' => 'ConsultaTimbre',
        ],

        // consumer Invoice Services (Domain: fc)
        'consumer_invoice' => [
            'send' => 'recepcionfc/api/recepcion/ecf',
            'status' => 'consultarfce/api/Consultas/Consulta',
            'qr' => 'ConsultaTimbreFC',
        ],

        // Cancellation Range Services (Domain: ecf)
        'cancellation' => [
            'send' => 'anulacionrangos/api/operaciones/anularrango',
        ],

        // Commercial Approval Services (Domain: ecf)
        'approval' => [
            'send' => 'aprobacioncomercial/api/aprobacioncomercial',
        ],

        // Status & Availability Services (Domain: statusecf)
        'status' => [
            'services' => 'api/estatusservicios/obtenerestatus',
            'maintenance' => 'api/estatusservicios/obtenerventanasmantenimiento',
            'environment' => 'api/estatusservicios/verificarestado',
        ],
    ],

];
