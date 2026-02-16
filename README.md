# Laravel DGII

Paquete de Laravel para interactuar con los servicios web de la **Dirección General de Impuestos Internos (DGII)** de República Dominicana.

Proporciona una integración lista para usar con las APIs de **Comprobantes Fiscales Electrónicos (e-CF)**, incluyendo autenticación, envío de facturas, consultas de estado, aprobaciones comerciales y más.

## ¿Qué hace este paquete?

Este paquete encapsula la comunicación con los endpoints del API de la DGII en una clase de servicio (`DgiiService`) que puedes inyectar en cualquier parte de tu aplicación Laravel.

### Funcionalidades disponibles

| Método | Descripción |
|--------|-------------|
| `fetchAuthXml()` | Obtiene la semilla XML para autenticación |
| `fetchToken()` | Valida la semilla firmada y obtiene el token de acceso |
| `sendInvoice()` | Envía una factura electrónica (e-CF) |
| `sendConsumerInvoice()` | Envía una factura de consumo (RFC) |
| `sendCommercialApproval()` | Envía una aprobación comercial |
| `sendCancellationRange()` | Envía una anulación de rango de secuencias |
| `getInvoiceStatus()` | Consulta el estado de una factura |
| `getInvoiceStatusByTrackId()` | Consulta el estado por Track ID |
| `getConsumerInvoiceStatus()` | Consulta el estado de una factura de consumo |
| `getTrackIdListBySequenceNumber()` | Obtiene los Track IDs por número de secuencia |
| `getInvoiceQRLink()` | Genera el enlace QR para el timbre fiscal |
| `getConsumerInvoiceQRLink()` | Genera el enlace QR para facturas de consumo |
| `fetchServiceStatus()` | Consulta el estado de los servicios de la DGII |
| `fetchMaintenanceWindows()` | Consulta las ventanas de mantenimiento programadas |
| `fetchEnvironmentStatus()` | Verifica el estado de un ambiente específico |

### Clase auxiliar

El paquete incluye `DgiiXmlHelper`, una clase utilitaria para extraer datos de los documentos XML de la DGII (eNCF, RNC emisor/comprador, totales, código de seguridad, fechas, etc.).

## Requisitos

- PHP 8.2+
- Laravel 11 o 12
- Extensión `simplexml`

## Instalación

```bash
composer require platinum-place/laravel-dgii
```

El Service Provider se registra automáticamente gracias al auto-discovery de Laravel.

### Publicar configuración

```bash
php artisan vendor:publish --tag=dgii-config
```

Esto creará el archivo `config/dgii.php` en tu proyecto.

## Configuración

Agrega las siguientes variables a tu archivo `.env`:

```env
DGII_ENVIRONMENT=testecf
DGII_API_KEY=tu-api-key
```

### Ambientes disponibles

| Valor | Ambiente |
|-------|----------|
| `testecf` | Pruebas |
| `certecf` | Certificación |
| `ecf` | Producción |

### Dominios (opcional)

Los dominios de los servicios de la DGII tienen valores por defecto. Solo necesitas configurarlos si la DGII cambia las URLs:

```env
DGII_DOMAIN_ECF=https://ecf.dgii.gov.do
DGII_DOMAIN_FC=https://fc.dgii.gov.do
DGII_DOMAIN_STATUS=https://statusecf.dgii.gov.do
```

## Uso

### Inyección de dependencias

```php
use PlatinumPlace\LaravelDgii\DgiiService;

class InvoiceController extends Controller
{
    public function __construct(
        protected DgiiService $dgii
    ) {}

    public function send()
    {
        // 1. Obtener semilla de autenticación
        $authXml = $this->dgii->fetchAuthXml();

        // 2. Firmar la semilla y obtener token
        // (la firma se realiza con platinum-place/php-dgii-xml-signer)
        $token = $this->dgii->fetchToken($signedXmlPath);

        // 3. Enviar factura
        $response = $this->dgii->sendInvoice($token['token'], $invoiceXmlPath);

        // 4. Consultar estado
        $status = $this->dgii->getInvoiceStatusByTrackId($token['token'], $response['trackId']);
    }
}
```

### Resolución desde el container

```php
$dgii = app(DgiiService::class);
$status = $dgii->fetchServiceStatus();
```

### Usar un ambiente diferente

Todos los métodos aceptan un parámetro `$env` opcional para sobrescribir el ambiente configurado:

```php
$authXml = $dgii->fetchAuthXml('certecf');
```

### Generar enlace QR

```php
$qrLink = $dgii->getInvoiceQRLink($xmlContent);
// https://ecf.dgii.gov.do/testecf/ConsultaTimbre?RncEmisor=...&ENCF=...
```

## Paquetes relacionados

| Paquete | Descripción |
|---------|-------------|
| [platinum-place/php-dgii-xml-signer](https://github.com/platinum-place/php-dgii-xml-signer) | Firmador XML para DGII (requerido para firmar semillas y facturas) |

## Licencia

MIT. Ver archivo [LICENSE](LICENSE) para más detalles.