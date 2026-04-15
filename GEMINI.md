# Laravel DGII - Guía de Desarrollo

Este proyecto es un paquete de Laravel diseñado para facilitar la integración con los servicios web de la **Dirección General de Impuestos Internos (DGII)** de la República Dominicana, específicamente para el manejo de **Comprobantes Fiscales Electrónicos (e-CF)**.

## 🚀 Resumen del Proyecto

El paquete automatiza el ciclo de vida de los documentos fiscales electrónicos, incluyendo la firma digital, autenticación automática, envío a los servidores de la DGII, y generación de representaciones impresas (PDF con QR).

### Tecnologías Principales
- **PHP 8.2+** y **Laravel 11/12**.
- **Firma XML:** `platinum-place/php-dgii-xml-signer`.
- **PDF & QR:** `barryvdh/laravel-dompdf` y `simplesoftwareio/simple-qrcode`.
- **HTTP:** Laravel HTTP Client (Guzzle).

## 🏗️ Arquitectura y Estructura

El paquete sigue una arquitectura orientada a servicios y acciones:

- **Actions (`src/Actions/`):** Orquestadores de alto nivel. Cada acción realiza una tarea completa (ej: `SignInvoiceAction` genera, firma y almacena el XML).
- **Clients (`src/Clients/`):** `DgiiClient` encapsula todas las peticiones HTTP a los distintos endpoints de la DGII (E-CF, Factura de Consumo, Estatus).
- **Value Objects (`src/ValueObjects/`):** Clases que envuelven los documentos XML para facilitar la extracción de datos de forma tipada (ej: `InvoiceXml`).
- **Data Transfer Objects (`src/Data/`):** `InvoiceData` transporta información entre acciones.
- **Templates (`resources/views/`):** Contiene las plantillas Blade para generar los diferentes tipos de XML (e-CF 31, 32, 33, 41, etc.).

## 🛠️ Comandos de Desarrollo

### Instalación (para usuarios)
```bash
composer require platinum-place/laravel-dgii
php artisan vendor:publish --tag=dgii-config
```

### Ejecución de Pruebas
El proyecto utiliza PHPUnit y Laravel Testbench.
```bash
composer test
# O directamente
./vendor/bin/phpunit
```

## 📝 Convenciones de Desarrollo

1.  **Actions:** Se prefiere el uso de Actions inyectadas por el contenedor de Laravel para mantener la lógica de negocio aislada y reutilizable.
2.  **Manejo de XML:** Nunca manipules el XML como string crudo si existe un Value Object disponible. Usa `InvoiceXml` para consultar propiedades.
3.  **Almacenamiento:** Siempre utiliza `StorageHelper` para interactuar con el disco configurado, permitiendo que el usuario cambie de `local` a `s3` sin afectar el código.
4.  **Autenticación:** No gestiones tokens manualmente a menos que sea estrictamente necesario; `AuthenticateAction` maneja el flujo de semilla/firma/token y su respectivo caché.

## ⚙️ Configuración Clave

El archivo `config/dgii.php` (publicable) centraliza:
- `environment`: `testecf` (default), `certecf` o `ecf`.
- `certificate_path` & `private_key_password`: Para la firma digital.
- `api_key`: Para servicios de estatus.
- `storage_disk` & `storage_path`: Ubicación de los XML firmados.

---
*Este archivo sirve como contexto para Gemini CLI. Mantener actualizado ante cambios arquitectónicos.*
