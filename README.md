# Laravel DGII

Paquete de Laravel para interactuar con los servicios web de la **Dirección General de Impuestos Internos (DGII)** de República Dominicana.

Proporciona una integración lista para usar con las APIs de **Comprobantes Fiscales Electrónicos (e-CF)**, incluyendo firma digital, autenticación con caché automático, envío de facturas, generación de QR, PDF fiscal y más. El paquete gestiona internamente todo el ciclo de vida del documento, desde la firma hasta el almacenamiento.

## Requisitos

- PHP 8.2+
- Laravel 11 o 12
- Extensiones: `ext-simplexml`, `ext-dom`, `ext-gd`
- Certificado digital (.p12 / .pfx) emitido por la DGII

## Instalación

```bash
composer require platinum-place/laravel-dgii
```

El Service Provider se registra automáticamente gracias al auto-discovery de Laravel.

### Publicar configuración y vistas

```bash
# Publicar solo la configuración
php artisan vendor:publish --tag=dgii-config

# Publicar las vistas (para personalizar el PDF o XML)
php artisan vendor:publish --tag=dgii-views
```

Esto creará el archivo `config/dgii.php` y las carpetas de vistas en `resources/views/vendor/dgii`.

---

## 🧪 Pruebas y Calidad de Código

El paquete incluye una suite de pruebas unitarias y herramientas de análisis estático para garantizar la estabilidad.

### Ejecutar Pruebas (PHPUnit)
```bash
composer test
```

### Estilo de Código (Laravel Pint)
```bash
./vendor/bin/pint
```

### Análisis Estático (PHPStan)
```bash
./vendor/bin/phpstan analyze
```

---

## 🛠️ Contribución

Si deseas contribuir al desarrollo de este paquete, por favor revisa nuestra guía de contribución (PRs son bienvenidos). Asegúrate de que todos los tests pasen antes de enviar un cambio.

---

## 🛡️ Seguridad

Si descubres alguna vulnerabilidad relacionada con la seguridad, por favor envía un correo electrónico a soporte@platinumplace.do en lugar de utilizar el rastreador de problemas.

---

## Licencia

Agrega las siguientes variables a tu archivo `.env`:

```env
# Ambiente de ejecución
DGII_ENVIRONMENT=testecf

# Ruta al certificado digital (.p12 / .pfx) para firma de XML
DGII_CERT_PATH=/ruta/al/certificado.p12
DGII_KEY_PASSWORD=tu-contraseña

# API Key para los servicios de estatus (statusecf.dgii.gov.do)
DGII_API_KEY=tu-api-key

# Disco y directorio para almacenar los XML firmados
DGII_STORAGE_DISK=local
DGII_STORAGE_PATH=dgii/xmls
```

### Ambientes disponibles

| Valor | Ambiente |
|-------|----------|
| `testecf` | Pruebas (Sandbox) |
| `certecf` | Certificación |
| `ecf` | Producción |

### Opciones avanzadas

```env
# Dominios de los servicios (solo si la DGII cambia las URLs)
DGII_DOMAIN_ECF=https://ecf.dgii.gov.do
DGII_DOMAIN_FC=https://fc.dgii.gov.do
DGII_DOMAIN_STATUS=https://statusecf.dgii.gov.do

# Reglas de negocio para facturas de consumo
DGII_FC_TYPE=32        # Tipo de e-CF para Factura de Consumo (B32)
DGII_FC_LIMIT=250000   # Monto máximo (RD$) para factura de consumo simplificado

# Caché del token de autenticación
DGII_CACHE_PREFIX=dgii_token_
DGII_CACHE_BUFFER=600  # Segundos de margen antes de que expire el token
```

---

## Arquitectura

El paquete está organizado en tres capas principales:

| Capa | Clases | Responsabilidad |
|------|--------|-----------------|
| **Actions** | `SignInvoiceAction`, `SendInvoiceAction`, etc. | Orquestan el flujo completo de un proceso |
| **Clients** | `DgiiClient` | Realiza las peticiones HTTP a la API de la DGII |
| **Value Objects** | `InvoiceXml`, `CommercialApprovalXml`, `CancellationRangeXml` | Parsean y exponen los datos de los documentos XML |

### Autenticación automática con caché

El paquete gestiona el token de autenticación de forma completamente automática. `AuthenticateAction` obtiene la semilla XML, la firma digitalmente y solicita el token a la DGII. El token se almacena en caché (usando el driver configurado en tu app) y se reutiliza en peticiones posteriores hasta que esté próximo a vencer:

```php
// Internamente, todas las Actions que requieren token llaman a AuthenticateAction::handle()
// Tú no necesitas gestionar tokens manualmente.
```

### Almacenamiento de XML

Los XML firmados se guardan automáticamente en el disco y la ruta configurados (`DGII_STORAGE_DISK` / `DGII_STORAGE_PATH`). La estructura de directorios es:

```
{storage_path}/{año}/{mes}/{día}/{uuid}/{nombre}.xml
```

El `StorageService` de soporte utiliza el sistema de discos de Laravel (`Storage::disk()`), por lo que puedes configurar cualquier driver: `local`, `s3`, `spaces`, etc.

---

## Uso

### Flujo completo: Firmar y enviar una factura

La forma recomendada es inyectar las Actions directamente desde el contenedor de Laravel. Cada Action maneja internamente la autenticación y el almacenamiento.

```php
use PlatinumPlace\LaravelDgii\Actions\Invoice\CheckInvoiceStatusAction;use PlatinumPlace\LaravelDgii\Actions\Invoice\SendInvoiceAction;use PlatinumPlace\LaravelDgii\Actions\Invoice\SignInvoiceAction;use PlatinumPlace\LaravelDgii\Data\InvoiceData;

class InvoiceController extends Controller
{
    public function __construct(
        protected SignInvoiceAction        $signInvoice,
        protected SendInvoiceAction        $sendInvoice,
        protected CheckInvoiceStatusAction $checkStatus,
    ) {}

    public function send(array $invoiceData)
    {
        // 1. Firmar el XML (genera el e-CF y, si aplica, el RFCE para consumo)
        /** @var InvoiceData $signed */
        $signed = $this->signInvoice->handle($invoiceData);

        // 2. Enviar a la DGII (detecta automáticamente si es factura de consumo)
        $response = $this->sendInvoice->handle($signed->xmlPath);

        // 3. Consultar el estado
        $status = $this->checkStatus->handle($signed->xmlPath, $response['trackId']);

        return [
            'xmlPath' => $signed->xmlPath,
            'qrLink'  => $signed->qrLink,
            'trackId' => $response['trackId'],
            'status'  => $status,
        ];
    }
}
```

### Resultado de `SignInvoiceAction`: `InvoiceData`

El método `handle()` de `SignInvoiceAction` retorna un objeto `InvoiceData` con la siguiente estructura:

| Propiedad | Tipo | Descripción |
|-----------|------|-------------|
| `$xml` | `InvoiceXml` | Value Object con los datos parseados del XML firmado |
| `$xmlPath` | `string` | Ruta relativa del XML en el disco configurado |
| `$qrLink` | `string` | URL completa para el timbre fiscal (ConsultaTimbre) |
| `$integralInvoice` | `?InvoiceData` | Para facturas de consumo: contiene el e-CF raíz asociado |

### Usar un ambiente diferente al configurado

Todas las Actions aceptan parámetros opcionales para sobrescribir el ambiente y el certificado:

```php
$signed = $this->signInvoice->handle(
    data: $invoiceData,
    env: 'certecf',               // Sobrescribe DGII_ENVIRONMENT
    certPath: '/ruta/cert.p12',   // Sobrescribe DGII_CERT_PATH
    certPassword: 'password',     // Sobrescribe DGII_KEY_PASSWORD
);
```

### Aprobación comercial

```php
use PlatinumPlace\LaravelDgii\Actions\CommercialApproval\SendCommercialApprovalAction;

// $xmlPath: ruta (relativa al disco) del XML de aprobación comercial ya firmado
$response = app(SendCommercialApprovalAction::class)->handle($xmlPath);
```

### Anulación de rango de secuencias

```php
use PlatinumPlace\LaravelDgii\Actions\CancellationRange\SendCancellationRangeAction;

// $xmlPath: ruta del XML de anulación firmado
$response = app(SendCancellationRangeAction::class)->handle($xmlPath);
```

### Generar enlace QR

```php
use PlatinumPlace\LaravelDgii\Actions\Invoice\GenerateInvoiceQrLinkAction;

$qrLink = app(GenerateInvoiceQrLinkAction::class)->handle($xmlPath);
// https://ecf.dgii.gov.do/testecf/ConsultaTimbre?RncEmisor=...&ENCF=...
```

### Generar PDF fiscal

```php
use PlatinumPlace\LaravelDgii\Actions\Invoice\GenerateInvoicePdfAction;

// $xmlContent: contenido XML como cadena de texto
// $qrLink: URL del timbre generada con GenerateInvoiceQrLinkAction
// $logo: (opcional) contenido binario del logo de la empresa
$pdfContent = app(GenerateInvoicePdfAction::class)->handle($xmlContent, $qrLink, $logo);

return response($pdfContent, 200, ['Content-Type' => 'application/pdf']);
```

---

## Acceso directo a la API (bajo nivel)

Si necesitas acceder a los endpoints individualmente sin el flujo de Actions, puedes inyectar `DgiiClient`. En este caso, **debes gestionar el token manualmente**.

```php
use PlatinumPlace\LaravelDgii\Clients\DgiiClient;
use PlatinumPlace\LaravelDgii\Actions\AuthenticateAction;

class StatusController extends Controller
{
    public function __construct(
        protected DgiiClient        $client,
        protected AuthenticateAction $auth,
    ) {}

    public function serviceStatus(): array
    {
        return $this->client->fetchServiceStatus();
    }

    public function environmentStatus(): array
    {
        return $this->client->fetchEnvironmentStatus();
    }

    public function maintenanceWindows(): array
    {
        return $this->client->fetchMaintenanceWindows();
    }
}
```

### Métodos disponibles en `DgiiClient`

| Método | Descripción |
|--------|-------------|
| `fetchAuthXml(?string $env)` | Obtiene la semilla XML para autenticación |
| `fetchToken(string $xmlPath, ?string $env)` | Valida la semilla firmada y obtiene el token |
| `sendInvoice(string $token, string $xmlPath, ?string $env)` | Envía un e-CF estándar |
| `sendConsumerInvoice(string $token, string $xmlPath, ?string $env)` | Envía una factura de consumo (RFCE) |
| `sendCommercialApproval(string $token, string $xmlPath, ?string $env)` | Envía una aprobación comercial |
| `sendCancellationRange(string $token, string $xmlPath, ?string $env)` | Envía una anulación de rango de secuencias |
| `fetchInvoiceStatus(string $token, InvoiceXml $xml, ?string $env)` | Consulta el estado de un e-CF por sus datos |
| `fetchInvoiceStatusByTrackId(string $token, string $trackId, ?string $env)` | Consulta el estado por Track ID |
| `fetchConsumerInvoiceStatus(string $token, InvoiceXml $xml, ?string $env)` | Consulta el estado de una factura de consumo |
| `fetchTrackIdList(string $token, InvoiceXml $xml, ?string $env)` | Obtiene los Track IDs por número de secuencia |
| `fetchInvoiceQRLink(InvoiceXml $xml, ?string $env)` | Genera el enlace del timbre fiscal (e-CF) |
| `fetchConsumerInvoiceQRLink(InvoiceXml $xml, ?string $env)` | Genera el enlace del timbre (factura de consumo) |
| `fetchServiceStatus()` | Consulta el estado de los servicios de la DGII |
| `fetchMaintenanceWindows()` | Consulta las ventanas de mantenimiento programadas |
| `fetchEnvironmentStatus(?string $env)` | Verifica el estado de un ambiente específico |

---

## Value Objects

### `InvoiceXml`

Parsea un XML de factura firmada y expone sus datos:

```php
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceXml;

$invoice = new InvoiceXml($xmlString);

$invoice->getSenderIdentification(); // RNC del emisor
$invoice->getBuyerIdentification();  // RNC/cédula del comprador (nullable)
$invoice->getSequenceNumber();       // e-NCF (ej: E310000000001)
$invoice->getTotalAmount();          // Monto total
$invoice->getSecurityCode();         // Código de seguridad
$invoice->getReleaseDate();          // Fecha de emisión
$invoice->getSignatureDate();        // Fecha de firma
$invoice->isConsumeInvoice();        // true si es tipo 32 (consumo)
$invoice->getXmlName();              // Nombre sugerido para el archivo
```

---

## Paquetes incluidos como dependencias

| Paquete | Descripción |
|---------|-------------|
| [platinum-place/php-dgii-xml-signer](https://github.com/platinum-place/php-dgii-xml-signer) | Firma digital de XML con certificado DGII |
| [barryvdh/laravel-dompdf](https://github.com/barryvdh/laravel-dompdf) | Generación de PDF para el timbre fiscal |
| [simplesoftwareio/simple-qrcode](https://github.com/SimpleSoftwareIO/simple-qrcode) | Generación del código QR en el PDF |

---

## Licencia

MIT. Ver archivo [LICENSE](LICENSE) para más detalles.