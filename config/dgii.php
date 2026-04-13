<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Ambiente de la DGII
    |--------------------------------------------------------------------------
    |
    | Define el entorno de ejecución para las peticiones a la DGII.
    |
    | Valores soportados:
    | - 'testecf': Ambiente de Pruebas (Sandbox).
    | - 'certecf': Ambiente de Certificación.
    | - 'ecf': Ambiente de Producción.
    |
    */

    'environment' => env('DGII_ENVIRONMENT', 'testecf'),

    /*
    |--------------------------------------------------------------------------
    | Credenciales de Firma Electrónica
    |--------------------------------------------------------------------------
    |
    | Estas rutas son utilizadas por el paquete 'platinum-place/php-dgii-xml-signer'
    | para realizar la firma digital de los documentos XML (e-CF, Seed, etc.)
    | antes de ser enviados a la DGII.
    |
    */

    'certificate_path' => env('DGII_CERT_PATH'),

    'private_key_password' => env('DGII_KEY_PASSWORD', ''),

    /*
    |--------------------------------------------------------------------------
    | Api Key de servicios de Estatus
    |--------------------------------------------------------------------------
    |
    | La clave API proporcionada por la DGII necesaria para interactuar con
    | los servicios de estatus y disponibilidad (statusecf).
    |
    */

    'api_key' => env('DGII_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Dominios de servicios
    |--------------------------------------------------------------------------
    |
    | Aquí se definen las URLs base para los distintos servicios de la DGII. 
    | El paquete se encarga de construir la ruta final basándose en el 'environment'.
    |
    */

    'domains' => [
        'ecf'       => env('DGII_DOMAIN_ECF', 'https://ecf.dgii.gov.do'),
        'fc'        => env('DGII_DOMAIN_FC', 'https://fc.dgii.gov.do'),
        'statusecf' => env('DGII_DOMAIN_STATUS', 'https://statusecf.dgii.gov.do'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Persistencia de Documentos (Storage)
    |--------------------------------------------------------------------------
    |
    | Configura cómo y dónde el paquete debe guardar una copia de los XML
    | firmados que se generan.
    |
    | 'storage_disk': El nombre del disco configurado en 'config/filesystems.php' (ej.: 'local', 's3', 'spaces', 'public').
    | 'storage_path': Directorio dentro del disco donde se organizarán los archivos.
    |
    */

    'storage_disk' => env('DGII_STORAGE_DISK', 'local'),
    
    'storage_path' => env('DGII_STORAGE_PATH', 'dgii/xmls'),

    /*
    |--------------------------------------------------------------------------
    | Reglas de Negocio de la DGII
    |--------------------------------------------------------------------------
    |
    | Parámetros técnicos específicos para validaciones internas, como tipos
    | de comprobante y límites de facturación de consumo.
    |
    */

    'rules' => [
        // Tipo de e-CF para Factura de Consumo (estándar 32)
        'fc_type'  => (int) env('DGII_FC_TYPE', 32),

        // Límite de monto para que una factura sea considerada de consumo simplificado
        'fc_limit' => (int) env('DGII_FC_LIMIT', 250000),
    ],

    /*
    |--------------------------------------------------------------------------
    | Configuración de Caché
    |--------------------------------------------------------------------------
    |
    | El paquete almacena el token de autenticación en caché para evitar
    | solicitudes innecesarias a la DGII en cada petición.
    |
    | 'prefix': Prefijo único para las llaves de caché del paquete.
    | 'buffer': Segundos de margen para expirar el token en caché antes de que
    | caduque realmente en la DGII (evita fallos por latencia).
    |
    */

    'cache' => [
        'prefix' => env('DGII_CACHE_PREFIX', 'dgii_token_'),
        'buffer' => (int) env('DGII_CACHE_BUFFER', 600),
    ],

];
