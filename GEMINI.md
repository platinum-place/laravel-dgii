# Laravel DGII - Guía de Desarrollo (v1.3.8)

Este proyecto es un paquete de Laravel diseñado para facilitar la integración con los servicios web de la **Dirección General de Impuestos Internos (DGII)** de la República Dominicana, específicamente para el manejo de **Comprobantes Fiscales Electrónicos (e-CF)**.

- **Documentación Oficial:** [Portal e-CF DGII](https://dgii.gov.do/cicloContribuyente/facturacion/comprobantesFiscalesElectronicosE-CF/Paginas/documentacionSobreE-CF.aspx)

## 🚀 Resumen del Proyecto

El paquete simplifica el ciclo de vida de los documentos fiscales electrónicos, proveyendo herramientas atómicas y sin estado para la firma digital, autenticación por semilla y comunicación HTTP optimizada.

### Tecnologías Principales
- **PHP 8.2+** y **Laravel 11/12**.
- **Firma XML:** `platinum-place/php-dgii-xml-signer`.
- **HTTP:** Guzzle mediante Laravel HTTP Client.

## 🏗️ Arquitectura y Estructura (v1.3.8)

El paquete sigue una filosofía minimalista y de facilitador (enabler). En esta versión se ha consolidado la lógica de negocio antes fragmentada en múltiples acciones hacia servicios dedicados y cohesivos.

Para más detalles técnicos, consulta:
- **[Arquitectura del Sistema](./docs/internals/architecture.md)**
- **[Referencia del Facade](./docs/internals/facade.md)**

Estructura de directorios principal:
- **Services (`src/Services/`):** Contiene los servicios internos que procesan la firma digital y el renderizado XML (`DgiiXmlRender`), así como las peticiones HTTP (`DgiiClient`).
- **DgiiService (`src/Services/DgiiService.php`):** El único servicio del paquete, expuesto como un Gateway minimalista accesible mediante el Facade `Dgii`. Inyecta y orquesta los servicios internos.
- **Facades (`src/Facades/`):** Facade estático `Dgii` que redirige llamadas a `DgiiService`.
- **Providers (`src/Providers/`):** Configuración del contenedor de Laravel y macros de HTTP para la integración nativa y limpia.
- **Templates (`resources/views/`):** Plantillas Blade opcionales para la generación de XML dinámico.

## 🛠️ Comandos de Desarrollo

### Instalación (v1.3.8)
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
1.  **Facade Unificado:** Siempre prefiere el uso de `Dgii::metodo()` para interactuar con el paquete de forma cómoda.
2.  **Manejo de Datos:** Utiliza exclusivamente datos primitivos (`array` para respuestas JSON, `string` para XMLs firmados o planos). No se utilizan DTOs ni capas de repositorio pesadas.
3.  **DocBlocks:** Todo el código fuente debe estar documentado en **Inglés**.
4.  **Documentación:** Los archivos `.md` y guías de usuario se mantienen en **Español**.
5.  **Servicios Stateless:** Mantén los métodos y servicios internos 100% libres de estado (stateless). Recibe siempre secretos, contraseñas y tokens por argumentos en cada firma de método.
6.  **Extensibilidad:** Si necesitas agregar un nuevo endpoint de la DGII, añádelo en `DgiiClient` o `DgiiXmlRender` y expónlo a través de `DgiiService.php`.

## ⚙️ Referencia Técnica DGII

Para consultas sobre la normativa oficial y formatos XML de la DGII, utiliza la carpeta:
- **[Referencia DGII](./docs/reference/)** (Contiene manuales oficiales y guía para agentes IA).

## ⚙️ Configuración Clave (`config/dgii.php`)

El archivo de configuración únicamente almacena la parametrización de dominios de red y endpoints oficiales de la DGII:
- `domains`: URLs base para servicios de facturación, consumo y disponibilidad.
- `endpoints`: Paths relativos para autenticación, recepción de e-CF, anulaciones y estatus.

---
*Este archivo sirve como contexto para Gemini CLI. Mantener actualizado ante cambios arquitectónicos.*
