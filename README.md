# Laravel DGII 🇩🇴

[![Latest Version on Packagist](https://img.shields.io/packagist/v/platinum-place/laravel-dgii.svg?style=flat-square)](https://packagist.org/packages/platinum-place/laravel-dgii)
[![Total Downloads](https://img.shields.io/packagist/dt/platinum-place/laravel-dgii.svg?style=flat-square)](https://packagist.org/packages/platinum-place/laravel-dgii)
[![GitHub License](https://img.shields.io/github/license/platinum-place/laravel-dgii.svg?style=flat-square)](LICENSE)

Integración elegante con los servicios web de la **Dirección General de Impuestos Internos (DGII)** para el manejo de **Comprobantes Fiscales Electrónicos (e-CF)** en Laravel.

> [Read in English 🇺🇸](./README_EN.md) | **[Guía de Migración v1 a v2](./docs/migration-v2.md)**

---

## 🚀 Características principales

- **Firma Digital:** Firma automática de XML utilizando certificados `.p12` / `.pfx`.
- **Validación Robusta:** Validación preventiva de certificados antes de iniciar procesos de firma o envío.
- **Autenticación Inteligente:** Gestión automática de semillas y tokens con caché integrado.
- **Ciclo Completo e-CF:** Generación, firma, envío y consulta de estado de facturas electrónicas.
- **Soporte Extendido:** Facturas de crédito fiscal (31), consumo (32), notas de crédito (33), y más.
- **Documentos Especiales:** Aprobación comercial (ARECF) y Anulación de rangos (ANECF).
---

## 📦 Dependencias Core

Este paquete se apoya en soluciones robustas de la comunidad:

- **Firma XML:** `platinum-place/php-dgii-xml-signer`
- **HTTP Client:** Guzzle (vía Laravel HTTP Facade)

---

## 📖 Documentación

Índice completo de recursos para dominar la integración con la DGII:

- **[Guía de Migración (v1 a v2.0)](./docs/migration-v2.md)** - **Lectura obligatoria para usuarios existentes.**
- [Arquitectura del Sistema](./docs/architecture.md) - Entiende las capas de Repositorios, Datos y Acciones.
- [Estructuras de Datos (e-CF)](./docs/dgii-data-structures.md) - Detalle de campos para cada tipo de documento.
- [Servicios y Métodos](./docs/services.md) - Guía del `DgiiService` y monitoreo.
- [Catálogo de Acciones](./docs/actions.md) - Lista de acciones atómicas disponibles.
- [Convenciones del Proyecto](./docs/conventions.md) - Estándares de código e idioma.
- [Documentación Oficial DGII](https://dgii.gov.do/cicloContribuyente/facturacion/comprobantesFiscalesElectronicosE-CF/Paginas/documentacionSobreE-CF.aspx) - Manuales legales y técnicos.

## 🛠️ Instalación

```bash
composer require platinum-place/laravel-dgii
php artisan vendor:publish --tag=dgii-config
```

Configura tus credenciales en el archivo `.env`:

```env
DGII_ENVIRONMENT=testecf
DGII_CERT_PATH=storage/dgii/certs/mi_certificado.p12
DGII_KEY_PASSWORD=tu_password
DGII_API_KEY=tu_api_key
```

---

## 📖 Uso rápido (vía Facades)

El paquete utiliza un único Facade `Dgii` para todas las operaciones principales.

### Enviar una Factura (e-CF)
```php
use PlatinumPlace\LaravelDgii\Facades\Dgii;

// Los datos siguen la estructura oficial de la DGII
$invoiceData = [...]; 

// Firma, almacena y envía en un solo paso
$result = Dgii::submitInvoice($invoiceData);

// El resultado es un objeto InvoiceData con toda la información del ciclo de vida
echo $result->response->getTrackId();
echo $result->qrLink;
```

### Anulación de Rango (ANECF)
```php
use PlatinumPlace\LaravelDgii\Facades\Dgii;

$response = Dgii::sendCancellationRange($data);
```

### Consultar Estado de Servicios
```php
use PlatinumPlace\LaravelDgii\Facades\Dgii;

$status = Dgii::getServiceStatus();
```

---

## 🙋‍♂️ Soporte y Consultoría

Si necesitas asistencia técnica con la implementación de este paquete o tienes dudas generales sobre el ecosistema de **Facturación Electrónica en la República Dominicana**, puedes contactarme directamente.

Ofrezco servicios de consultoría especializada para empresas que buscan certificar sus sistemas ante la DGII.

- **Contacto:** Mis métodos de contacto actualizados están disponibles en mi **[Perfil de GitHub](https://github.com/platinum-place)**.
- **Issues:** Para errores del paquete, por favor abre un issue en este repositorio.

---

## ⚖️ Licencia

Este proyecto está bajo la Licencia MIT. Consulta el archivo [LICENSE](LICENSE) para más detalles.
