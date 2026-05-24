# Laravel DGII 🇩🇴

[![Latest Version on Packagist](https://img.shields.io/packagist/v/platinum-place/laravel-dgii.svg?style=flat-square)](https://packagist.org/packages/platinum-place/laravel-dgii)
[![Total Downloads](https://img.shields.io/packagist/dt/platinum-place/laravel-dgii.svg?style=flat-square)](https://packagist.org/packages/platinum-place/laravel-dgii)
[![GitHub License](https://img.shields.io/github/license/platinum-place/laravel-dgii.svg?style=flat-square)](LICENSE)

Integración minimalista y elegante con los servicios web de la **Dirección General de Impuestos Internos (DGII)** para el manejo de **Comprobantes Fiscales Electrónicos (e-CF)** en Laravel.

> [Read in English 🇺🇸](./README_EN.md)

---

## 🎯 Filosofía del Paquete

Este paquete sigue una **filosofía de facilitador (enabler)**:
* **El que sabe usar la DGII sabe usar el paquete.**
* No intentamos "esconder" ni duplicar las validaciones o flujos de la DGII bajo modelos complejos o DTOs pesados.
* El paquete es **100% libre de estado (stateless)** y no almacena credenciales ni claves en el archivo de configuración. Todo (entornos, tokens de acceso, certificados, contraseñas, llaves de API) se suministra en tiempo de ejecución por quien consume el método.
* Facilitamos únicamente las partes complejas de la integración:
  1. La **firma digital PKCS#12** de los XMLs.
  2. La **autenticación** mediante el ciclo Semilla -> Firma -> Token de acceso.
  3. La **comunicación HTTP** nativa optimizada con macros de Laravel para subir y consultar e-CF.

---

## 🏗️ Estructura de Directorios

* **Domains (`src/Domains/`):** Contiene acciones atómicas (`Actions`) independientes por dominio de negocio (Invoices, ConsumerInvoices, Seeds, CancellationRanges, CommercialApprovals, Acknowledgments, Dgii).
* **DgiiService (`src/DgiiService.php`):** Gateway minimalista expuesto mediante el Facade `Dgii` que inyecta y expone de forma directa estas acciones.
* **Templates (`resources/views/`):** Vistas Blade opcionales para la estructuración de XMLs de e-CF estándar, de consumo, anulaciones y acuses.

---

## 🛠️ Instalación

Instala el paquete mediante Composer:

```bash
composer require platinum-place/laravel-dgii
```

Publica el archivo de configuración opcional para endpoints y dominios:

```bash
php artisan vendor:publish --tag=dgii-config
```

---

## 🚀 Uso Rápido (vía Facades)

Toda interacción pública se realiza a través del Facade `Dgii`.

### 1. Obtener Semilla y Autenticarse

```php
use PlatinumPlace\LaravelDgii\Facades\Dgii;

// 1. Obtener semilla limpia desde la DGII
$seedXml = Dgii::getSeed('testecf'); // testecf (sandbox), certecf (certificación), ecf (producción)

// 2. [Tu aplicación] Firma digitalmente el XML de la semilla y guárdalo en un archivo.
// 3. Intercambiar la semilla firmada por un access token oficial
$authInfo = Dgii::verifySeed('testecf', '/ruta/a/semilla_firmada.xml');

$accessToken = $authInfo['token'];
```

### 2. Generar y Firmar Facturas (e-CF)

Puedes usar las plantillas Blade del paquete o generar tu propio XML y firmarlo manualmente usando el SignManager integrado.

```php
use PlatinumPlace\LaravelDgii\Facades\Dgii;

$invoiceData = [
    'IdDoc' => ['TipoeCF' => 31, 'eNCF' => 'E310000000001', ...],
    'Emisor' => [...],
    'Comprador' => [...],
    'DetallesItems' => [...]
];

$certContent = file_get_contents('/ruta/al/certificado.p12');
$certPassword = 'tu_contraseña';

// Genera el XML y aplica la firma digital PKCS#12
$signedXml = Dgii::renderInvoice($certContent, $certPassword, $invoiceData);

// [Tu aplicación] Guarda el XML firmado donde prefieras en tu disco local o base de datos.
```

### 3. Enviar e-CF y Consultar Estatus

```php
use PlatinumPlace\LaravelDgii\Facades\Dgii;

// 1. Enviar el XML firmado a la DGII (especificando el ambiente, token y archivo)
$result = Dgii::sendInvoice('testecf', $accessToken, '/ruta/al/comprobante_firmado.xml');

$trackId = $result['trackId'];

// 2. Consultar el estado de procesamiento del comprobante mediante el trackId
$status = Dgii::findInvoice('testecf', $accessToken, $trackId);
```

### 4. Consultar Estatus de Servicios de la DGII

```php
use PlatinumPlace\LaravelDgii\Facades\Dgii;

$apiKey = 'tu_api_key';

// Consulta el estado general
$services = Dgii::getServiceStatus($apiKey);

// Consulta las ventanas de mantenimiento programadas
$maintenance = Dgii::getMaintenanceWindows($apiKey);
```

---

## 📖 Documentación Completa

- **[Primeros Pasos](./docs/usage/getting-started.md)** - Guía detallada para comenzar la integración.
- **[Arquitectura de Dominio](./docs/internals/architecture.md)** - Detalle técnico del sistema de acciones.
- **[Catálogo de Acciones](./docs/internals/actions.md)** - Listado completo de acciones disponibles en `src/Domains/`.
- **[Estructuras de Datos](./docs/usage/data-structures.md)** - Detalle del formato esperado en los arrays para renderizar XMLs.

---

## ⚖️ Licencia

Este proyecto está bajo la Licencia MIT. Consulta el archivo [LICENSE](LICENSE) para más detalles.
