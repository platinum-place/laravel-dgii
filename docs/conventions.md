# Convenciones del Proyecto

Este proyecto mantiene un estándar estricto en cuanto al idioma y estilo de código para garantizar profesionalismo, compatibilidad internacional y claridad para el equipo de desarrollo.

## Idioma del Código Fuente

**Todo el código fuente debe escribirse en INGLÉS.**

Esto incluye, pero no se limita a:
- **Nombres de Clases y Interfaces:** (ej. `InvoiceData`, `DgiiClientInterface`).
- **Nombres de Métodos y Funciones:** (ej. `sendInvoice`, `handleResponse`).
- **Nombres de Variables y Propiedades:** (ej. `$signedXml`, `$accessToken`).
- **Nombres de Base de Datos y Configuración:** (ej. `storage_disk`, `api_key`).
- **DocBlocks y Comentarios Técnicos:** Todos los bloques de documentación de PHP y comentarios dentro del código deben estar redactados en inglés siguiendo los estándares de la industria.

*Razón: El inglés es el lenguaje universal de la programación y facilita la integración con librerías externas y la colaboración global.*

## Idioma de la Documentación

**Toda la documentación dirigida a usuarios y desarrolladores debe escribirse en ESPAÑOL.**

Esto incluye:
- **Archivos Markdown (.md):** (ej. `README.md`, `ARCHITECTURE.md`, `docs/*.md`).
- **Mensajes de Git:** Los mensajes de commit deben seguir el estándar de *Conventional Commits* y estar redactados en español (ej. `feat(invoice): agregar soporte para facturas de consumo`).

*Razón: Al ser un paquete diseñado específicamente para la República Dominicana (DGII), la documentación en español asegura una mejor comprensión para el público objetivo.*

## Estilo de Código

- **PSR-12:** Seguimos rigurosamente los estándares de estilo de PHP (PSR-12).
- **Laravel Pint:** Es obligatorio ejecutar `Laravel Pint` antes de realizar cualquier commit para asegurar la consistencia del estilo.
- **Tipado Fuerte:** Se requiere el uso de tipos en las propiedades de las clases, parámetros de métodos y tipos de retorno (PHP 8.2+).
- **Composicón sobre Herencia:** Preferimos el uso de `Actions` inyectadas y composición para extender la funcionalidad en lugar de jerarquías de clases complejas.
