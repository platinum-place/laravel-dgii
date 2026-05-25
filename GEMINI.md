# Laravel DGII - Guía de Desarrollo (v1.0)

Este proyecto es un paquete de Laravel diseñado para facilitar la integración con los servicios web de la **Dirección General de Impuestos Internos (DGII)** de la República Dominicana, específicamente para el manejo de **Comprobantes Fiscales Electrónicos (e-CF)**.

- **Documentación Oficial:** [Portal e-CF DGII](https://dgii.gov.do/cicloContribuyente/facturacion/comprobantesFiscalesElectronicosE-CF/Paginas/documentacionSobreE-CF.aspx)

## 🚀 Resumen del Proyecto

El paquete simplifica el ciclo de vida de los documentos fiscales electrónicos, proveyendo herramientas atómicas y sin estado para la firma digital, autenticación por semilla y comunicación HTTP optimizada.

### Tecnologías Principales
- **PHP 8.2+** y **Laravel 11/12**.
- **Firma XML:** `platinum-place/php-dgii-xml-signer`.
- **HTTP:** Laravel HTTP Client (Guzzle).

## 🏗️ Arquitectura y Estructura (v2.3)

El paquete sigue una filosofía minimalista y de facilitador (enabler). En esta versión, se ha simplificado el acceso a los servicios de estatus permitiendo una configuración global de la API Key.

Para más detalles técnicos, consulta:
- **[Arquitectura del Sistema](./docs/internals/architecture.md)**
- **[Catálogo de Acciones](./docs/internals/actions.md)**

Estructura de directorios principal:
- **Actions (`src/Actions/`):** Contiene todas las acciones atómicas e independientes encargadas de la lógica de negocio.
- **DgiiService (`src/DgiiService.php`):** El único servicio del paquete, expuesto como un Gateway minimalista accesible mediante el Facade `Dgii`. Inyecta directamente las acciones.
- **Facades (`src/Facades/`):** Facade estático `Dgii` que redirige llamadas a `DgiiService`.
- **Providers (`src/Providers/`):** Configuración del contenedor de Laravel y macros de HTTP para la integración nativa y limpia.
- **Templates (`resources/views/`):** Plantillas Blade opcionales para la generación de XML dinámico.

## 🛠️ Comandos de Desarrollo

### Instalación (v2.3)
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

Consulta la guía completa en **[Convenciones del Proyecto](./docs/internals/conventions.md)**.

Resumen:
1.  **Facade Unificado:** Siempre prefiere el uso de `Dgii::metodo()` para interactuar con el paquete.
2.  **Manejo de Datos:** Utiliza exclusivamente datos primitivos (`array` para respuestas JSON, `string` para XMLs firmados o planos). No se utilizan DTOs ni capas de repositorio pesadas.
3.  **DocBlocks:** Todo el código fuente debe estar documentado en **Inglés**.
4.  **Documentación:** Los archivos `.md` y guías de usuario se mantienen en **Español**.
5.  **Actions:** Mantén las acciones atómicas y 100% libres de estado (stateless). Recibe siempre secretos, contraseñas y tokens por argumentos en `handle()`.
6.  **Extensibilidad:** Si necesitas agregar un nuevo endpoint de la DGII, crea una acción dedicada en `src/Actions/` e inyéctala en `DgiiService.php`.

## ⚙️ Referencia Técnica DGII

Para consultas sobre la normativa oficial y formatos XML de la DGII, utiliza la carpeta:
- **[Referencia DGII](./docs/reference/)** (Contiene manuales oficiales y guía para agentes IA).

## ⚙️ Configuración Clave (`config/dgii.php`)

El archivo de configuración únicamente almacena la parametrización de dominios de red y endpoints oficiales de la DGII:
- `domains`: URLs base para servicios de facturación, consumo y disponibilidad.
- `endpoints`: Paths relativos para autenticación, recepción de e-CF, anulaciones y estatus.

---
*Este archivo sirve como contexto para Gemini CLI. Mantener actualizado ante cambios arquitectónicos.*
