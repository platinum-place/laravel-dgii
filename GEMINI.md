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

- **Support (`src/Support/`):** Utilidades técnicas (XmlSigner para firmas, StorageService para manejo de archivos).
- **Abstracts (`src/Abstracts/`):** Contiene `AbstractXml`, la clase base que unifica la validación y el acceso estructurado a todos los documentos XML.
- **Services (`src/Services/`):** Fachadas de alto nivel para el usuario final (`DgiiInvoiceService`, `DgiiSeedService`, `DgiiCancellationRangeService`, `DgiiCommercialApprovalService`).
- **Actions (`src/Actions/`):** Orquestadores de lógica de negocio aislada. Cada acción realiza una tarea atómica y completa (ej: `SignInvoiceAction`, `SendCancellationRangeAction`). Incluye sub-namespaces para `Invoice`, `CancellationRange`, `CommercialApproval`, `Acknowledgment` y `Seed`.
- **Clients (`src/Clients/`):** Clientes especializados (`InvoiceClient`, `SeedClient`, `CancellationRangeClient`, `CommercialApprovalClient`, `ConsumeInvoiceClient`) que encapsulan las peticiones HTTP a los endpoints de la DGII.
- **Value Objects (`src/ValueObjects/`):** Objetos inmutables que envuelven los XML (`InvoiceXml`, `AcknowledgmentXml`, `CancellationRangeXml`, `CommercialApprovalXml`) o agrupan datos de respuesta (`InvoiceReceived`, `CancellationRangeReceived`).
- **Data Transfer Objects (`src/Data/`):** `InvoiceData`, `CancellationRangeData` y `CommercialApprovalData` transportan el estado completo de una transacción entre las capas del sistema.
- **Templates (`resources/views/`):** Plantillas Blade para generar los diferentes tipos de XML requeridos por la DGII.

## 🛠️ Comandos de Desarrollo

### Instalación (para usuarios)
```bash
composer require platinum-place/laravel-dgii
php artisan vendor:publish --tag=dgii-config
```

### Ejecución de Pruebas y Estilo
El proyecto utiliza PHPUnit para pruebas y Laravel Pint para mantener el estilo de código. **Es obligatorio ejecutar Pint antes de subir cambios.**

```bash
# Ejecutar Pint para corregir estilo
./vendor/bin/pint

# Ejecutar pruebas
composer test
# O directamente
./vendor/bin/phpunit
```

## 📝 Convenciones de Desarrollo

1.  **Actions:** Se prefiere el uso de Actions inyectadas por el contenedor de Laravel (`app(Action::class)->handle()`) para mantener la lógica de negocio aislada y reutilizable.
2.  **Manejo de XML:** Nunca manipules el XML como string crudo si existe un Value Object disponible. Todos deben heredar de `AbstractXml` para garantizar validación consistente.
3.  **DocBlocks:** Todo el código fuente debe estar documentado utilizando DocBlocks en **Inglés** para mantener estándares de industria, mientras que los archivos de documentación (.md) se mantienen en **Español**.
4.  **Almacenamiento:** Siempre utiliza `StorageService` para interactuar con el disco configurado. Los archivos se organizan automáticamente por `Año/Mes/Día/UUID`.
5.  **Autenticación:** El flujo de obtención de tokens (Semilla -> Firma -> Validación) se gestiona automáticamente a través de `AuthenticateAction`, incluyendo un sistema de caché con margen de seguridad (buffer).

## ⚙️ Configuración Clave (`config/dgii.php`)

- `environment`: `testecf` (default), `certecf` o `ecf`.
- `certificate` & `certificate_password`: Credenciales para la firma digital.
- `api_key`: Para servicios de consulta de estatus.
- `storage_disk` & `storage_path`: Configuración de persistencia de archivos.
- `rules`: Parámetros técnicos como límites de montos para facturas de consumo.

---
*Este archivo sirve como contexto para Gemini CLI. Mantener actualizado ante cambios arquitectónicos.*
