# Laravel DGII - Guía de Desarrollo

Este proyecto es un paquete de Laravel diseñado para facilitar la integración con los servicios web de la **Dirección General de Impuestos Internos (DGII)** de la República Dominicana, específicamente para el manejo de **Comprobantes Fiscales Electrónicos (e-CF)**.

- **Documentación Oficial:** [Portal e-CF DGII](https://dgii.gov.do/cicloContribuyente/facturacion/comprobantesFiscalesElectronicosE-CF/Paginas/documentacionSobreE-CF.aspx)

## 🚀 Resumen del Proyecto

El paquete automatiza el ciclo de vida de los documentos fiscales electrónicos, incluyendo la firma digital, autenticación automática y envío a los servidores de la DGII.

### Tecnologías Principales
- **PHP 8.2+** y **Laravel 11/12**.
- **Firma XML:** `platinum-place/php-dgii-xml-signer`.
- **HTTP:** Laravel HTTP Client (Guzzle).

## 🏗️ Arquitectura y Estructura (v2.0)

El paquete sigue una arquitectura orientada a servicios y acciones altamente desacoplada:

- **Data (`src/Data/`):** Contiene el núcleo de datos del paquete. Unifica DTOs (`InvoiceData`), representaciones XML (`AbstractXml`, `InvoiceXml`) y objetos de respuesta (`InvoiceResponse`).
- **Repositories (`src/Repositories/`):** Capa de abstracción para persistencia y comunicación externa. Incluye `DgiiInvoiceRepository` para la API de la DGII y `StorageRepository` para el sistema de archivos.
- **Services (`src/Services/`):** El orquestador principal es `DgiiService` (accedido vía el facade `Dgii`). Coordina el flujo de trabajo entre acciones y repositorios.
- **Actions (`src/Actions/`):** Lógica de negocio atómica y aplanada. Cada clase realiza una única tarea técnica (ej: `SignInvoiceAction`, `SubmitInvoiceAction`, `StorageInvoiceAction`).
- **Providers (`src/Providers/`):** Configuración del contenedor de Laravel y macros de HTTP para la integración con la DGII.
- **Templates (`resources/views/`):** Plantillas Blade para la generación de XML dinámico.

## 🛠️ Comandos de Desarrollo

### Instalación (v2.0)
```bash
composer require platinum-place/laravel-dgii
php artisan vendor:publish --tag=dgii-config
```

### Ejecución de Pruebas y Estilo
El proyecto utiliza PHPUnit para pruebas y Laravel Pint para el estilo.

```bash
# Ejecutar Pint para corregir estilo
./vendor/bin/pint

# Ejecutar pruebas
composer test
```

## 📝 Convenciones de Desarrollo

1.  **Facade Unificado:** Siempre prefiere el uso de `Dgii::metodo()` para interactuar con el paquete.
2.  **Manejo de Datos:** Utiliza exclusivamente los objetos en `src/Data` para transportar información. Nunca manipules XML como strings crudos fuera de las capas de bajo nivel.
3.  **DocBlocks:** Todo el código fuente debe estar documentado en **Inglés**.
4.  **Documentación:** Los archivos `.md` y guías de usuario se mantienen en **Español**.
5.  **Actions:** Mantén las acciones atómicas. Si una acción necesita hacer "demasiado", divídela en acciones más pequeñas o delega la orquestación al `DgiiService`.
6.  **Almacenamiento:** Utiliza `StorageRepository` para garantizar la organización automática por fecha y UUID.

## ⚙️ Configuración Clave (`config/dgii.php`)

- `environment`: `testecf` (default), `certecf` o `ecf`.
- `certificate` & `certificate_password`: Credenciales para la firma digital.
- `api_key`: Para servicios de consulta de estatus.
- `storage_disk` & `storage_path`: Configuración de persistencia de archivos.
- `rules`: Parámetros técnicos como límites de montos para facturas de consumo.

---
*Este archivo sirve como contexto para Gemini CLI. Mantener actualizado ante cambios arquitectónicos.*
