# Laravel DGII 🇩🇴

[![Latest Version on Packagist](https://img.shields.io/packagist/v/platinum-place/laravel-dgii.svg?style=flat-square)](https://packagist.org/packages/platinum-place/laravel-dgii)
[![Total Downloads](https://img.shields.io/packagist/dt/platinum-place/laravel-dgii.svg?style=flat-square)](https://packagist.org/packages/platinum-place/laravel-dgii)
[![GitHub License](https://img.shields.io/github/license/platinum-place/laravel-dgii.svg?style=flat-square)](LICENSE)

---

## 🎯 Filosofía del Paquete

Este paquete sigue una **filosofía de facilitador (enabler)**:
* **El que sabe usar la DGII sabe usar el paquete.**
* No intentamos "esconder" ni duplicar las validaciones o flujos de la DGII bajo modelos complejos o DTOs pesados.
* El paquete es **100% libre de estado (stateless)** y no almacena credenciales ni claves en el archivo de configuración. Todo (entornos, tokens de acceso, certificados, contraseñas) se suministra en tiempo de ejecución por quien consume el método.
* Facilitamos únicamente las partes complejas de la integración:
  1. La **firma digital PKCS#12** de los XMLs.
  2. La **autenticación** mediante el ciclo Semilla -> Firma -> Token de acceso.
  3. La **comunicación HTTP** nativa optimizada con macros de Laravel para subir y consultar e-CF.

---

## 🏗️ Estructura de Directorios

* **Services (`src/Services/`):** Contiene los servicios internos encargados del renderizado y firma digital de los XMLs (`DgiiXmlRender`) y del envío de peticiones HTTP a los servidores web de la DGII (`DgiiClient`).
* **DgiiService (`src/Services/DgiiService.php`):** Gateway minimalista expuesto mediante el Facade `Dgii` que inyecta y orquesta los servicios internos para exponer firmas de métodos limpias.
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
$result = Dgii::renderInvoice($certContent, $certPassword, $invoiceData);

// Contiene 'xml' (el string firmado) y opcionalmente 'integral'
$signedXml = $result['xml'];

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

Para estos métodos de disponibilidad, asegúrate de tener configurada tu `DGII_API_KEY` en tu `.env`.

```php
use PlatinumPlace\LaravelDgii\Facades\Dgii;

// Consulta el estado general de disponibilidad de los servicios de la DGII
$services = Dgii::getServiceStatus();

// Consulta las ventanas de mantenimiento programadas por la DGII
$maintenance = Dgii::getMaintenanceWindows();
```

---

## 📖 Documentación Completa

- **[Primeros Pasos](./docs/usage/getting-started.md)** - Guía detallada para comenzar la integración.
- **[Arquitectura de Servicios](./docs/internals/architecture.md)** - Detalle técnico del sistema de servicios.
- **[Referencia del Facade](./docs/internals/facade.md)** - Listado y especificación detallada de todos los métodos expuestos a través del Facade `Dgii`.
- **[Estructuras de Datos](./docs/usage/data-structures.md)** - Detalle del formato esperado en los arrays para renderizar XMLs utilizando las plantillas Blade.

---

## 🙋‍♂️ Soporte y Consultoría

Si necesitas asistencia técnica con la implementación de este paquete o tienes dudas generales sobre el ecosistema de **Facturación Electrónica en la República Dominicana**, puedes contactarme directamente.

Ofrezco servicios de consultoría especializada para empresas que buscan certificar sus sistemas ante la DGII.

- **Contacto:** Mis métodos de contacto actualizados están disponibles en mi **[Perfil de GitHub](https://github.com/platinum-place)**.
- **Issues:** Para errores del paquete, por favor abre un issue en este repositorio.

---

## ⚖️ Licencia

Este proyecto está bajo la Licencia MIT. Consulta el archivo [LICENSE](LICENSE) para más detalles.
