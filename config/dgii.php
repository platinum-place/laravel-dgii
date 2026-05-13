<?php

return [

    /*
    |--------------------------------------------------------------------------
    | DGII Environment
    |--------------------------------------------------------------------------
    |
    | Defines the execution environment for requests sent to DGII.
    |
    | Supported values:
    | - 'testecf': Testing Environment (Sandbox).
    | - 'certecf': Certification Environment.
    | - 'ecf': Production Environment.
    |
    */

    'environment' => env('DGII_ENVIRONMENT', 'testecf'),

    /*
    |--------------------------------------------------------------------------
    | Electronic Signature Credentials
    |--------------------------------------------------------------------------
    |
    | These paths and passwords are used by the digital signing service
    | to sign XML documents (e-CF, Seed, etc.) before they are sent to DGII.
    |
    */

    'certificate' => env('DGII_CERT_PATH'),

    'certificate_password' => env('DGII_KEY_PASSWORD', ''),

    /*
    |--------------------------------------------------------------------------
    | Status Services API Key
    |--------------------------------------------------------------------------
    |
    | The API Key provided by DGII required to interact with status and
    | availability services (statusecf).
    |
    */

    'api_key' => env('DGII_API_KEY'),

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
        'invoice' => env('DGII_DOMAIN_ECF', 'https://ecf.dgii.gov.do'),
        'consume_invoice' => env('DGII_DOMAIN_FC', 'https://fc.dgii.gov.do'),
        'status' => env('DGII_DOMAIN_STATUS', 'https://statusecf.dgii.gov.do'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Document Persistence (Storage)
    |--------------------------------------------------------------------------
    |
    | Configure how and where the package should save a copy of the
    | signed XML documents generated.
    |
    | 'storage_disk': The name of the disk configured in 'config/filesystems.php'.
    | 'storage_path': Directory inside the disk where files will be organized.
    |
    */

    'storage_disk' => env('DGII_STORAGE_DISK', 'local'),

    'storage_path' => env('DGII_STORAGE_PATH', 'dgii/xmls'),

    /*
    |--------------------------------------------------------------------------
    | DGII Business Rules
    |--------------------------------------------------------------------------
    |
    | Specific technical parameters for internal validations, such as
    | document types and consume billing limits.
    |
    */

    'rules' => [
        // Default e-CF type for consume Invoice (Standard 32)
        'consume_invoice_type' => (int) env('DGII_CONSUME_INVOICE_TYPE', 32),

        // Amount limit for an invoice to be considered simplified consume
        'consume_invoice_limit' => (int) env('DGII_CONSUME_INVOICE_LIMIT', 250000),
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Configuration
    |--------------------------------------------------------------------------
    |
    | The package caches the authentication token to avoid unnecessary
    | requests to DGII on every transaction.
    |
    | 'prefix': Unique prefix for the package's cache keys.
    | 'buffer': Margin in seconds to expire the cached token before it
    | actually expires at DGII (prevents latency failures).
    |
    */

    'cache' => [
        'prefix' => env('DGII_CACHE_PREFIX', 'dgii_token_'),
        'buffer' => (int) env('DGII_CACHE_BUFFER', 600),
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

        // consume Invoice Services (Domain: fc)
        'consume_invoice' => [
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
