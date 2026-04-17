# Laravel DGII 🇩🇴

[![Latest Version on Packagist](https://img.shields.io/packagist/v/platinum-place/laravel-dgii.svg?style=flat-square)](https://packagist.org/packages/platinum-place/laravel-dgii)
[![Total Downloads](https://img.shields.io/packagist/dt/platinum-place/laravel-dgii.svg?style=flat-square)](https://packagist.org/packages/platinum-place/laravel-dgii)
[![GitHub License](https://img.shields.io/github/license/platinum-place/laravel-dgii.svg?style=flat-square)](LICENSE)

Integración elegante con los servicios web de la **Dirección General de Impuestos Internos (DGII)** para el manejo de **Comprobantes Fiscales Electrónicos (e-CF)** en Laravel.

> [Read in English 🇺🇸](./README_EN.md)

---

## 🚀 Características principales

- **Firma Digital:** Firma automática de XML utilizando certificados `.p12` / `.pfx`.
- **Autenticación Inteligente:** Gestión automática de semillas y tokens con caché integrado.
- **Ciclo Completo e-CF:** Generación, firma, envío y consulta de estado de facturas electrónicas.
- **Soporte Extendido:** Facturas de crédito fiscal (31), consumo (32), notas de crédito (33), y más.
- **Documentos Especiales:** Aprobación comercial (ARECF) y Anulación de rangos (ANECF).
- **Representación Impresa:** Generación de PDF fiscal con código QR dinámico.

---

## 📦 Dependencias Core

Este paquete se apoya en soluciones robustas de la comunidad:

- **Firma XML:** `platinum-place/php-dgii-xml-signer`
- **Generación PDF:** `barryvdh/laravel-dompdf`
- **Códigos QR:** `simplesoftwareio/simple-qrcode`
- **HTTP Client:** Guzzle (vía Laravel HTTP Facade)

---

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

El paquete está diseñado para ser usado mediante Facades, ocultando la complejidad de las Actions internas.

### Enviar una Factura (e-CF)
```php
use PlatinumPlace\LaravelDgii\Facades\DgiiInvoice;

// Los datos siguen la estructura oficial de la DGII
$invoiceData = [...]; 

// Firma, almacena y envía en un solo paso
$result = DgiiInvoice::send($invoiceData);

echo $result->invoiceReceived->getTrackId();
echo $result->storedInvoice->signedInvoice->qrLink;
```

### Anulación de Rango (ANECF)
```php
use PlatinumPlace\LaravelDgii\Facades\DgiiCancellationRange;

$response = DgiiCancellationRange::send($data);
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

- **Contacto:** Mis métodos de contacto actualizados están disponibles en mi **[Perfil de GitHub](https://github.com/warlyn)**.
- **Issues:** Para errores del paquete, por favor abre un issue en este repositorio.

---

## ⚖️ Licencia

Este proyecto está bajo la Licencia MIT. Consulta el archivo [LICENSE](LICENSE) para más detalles.
