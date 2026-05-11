# Documentación Técnica DGII (e-CF)

Esta carpeta contiene los manuales técnicos oficiales de la DGII (Dirección General de Impuestos Internos) de la República Dominicana para la implementación de la Facturación Electrónica (e-CF).

## Propósito para Agentes de IA
Utiliza esta documentación como fuente de verdad absoluta para cualquier consulta relacionada con la normativa de e-CF. No inventes estructuras XML ni procesos de firma; consulta siempre el archivo correspondiente antes de sugerir código o lógica de negocio.

## Índice de Documentos

| Archivo | Contenido Principal | Cuándo Consultar |
| :--- | :--- | :--- |
| `Descripcion-tecnica-de-facturacion-electronica.md` | Arquitectura general, ambientes (certificación/producción), tipos de servicios y flujos. | Consultar para entender el proceso global, ambientes y URLs de servicios. |
| `Firmado de e-CF.md` | Especificaciones de firma digital (XMLDSig), algoritmos, tipos de certificados y estructura del nodo `<Signature>`. | Consultar para implementar o depurar la lógica de firma de documentos XML. |
| `Formato Comprobante Fiscal Electrónico (e-CF) V1.0.md` | Diccionario de datos y estructura detallada de todos los tipos de e-CF (Facturas, Créditos, Débitos, etc.). | Consultar para generar el XML del comprobante fiscal. |
| `Informe Técnico e-CF v1.0.md` | Validaciones del web service, códigos de error, estructura de respuestas y consultas de estado. | Consultar para manejar errores de la DGII y validar el estado de envío. |
| `Formato Acuse de Recibo v 1.0.md` | Estructura del XML que confirma la recepción técnica de un documento. | Consultar para implementar la recepción de documentos entre contribuyentes. |
| `Formato Anulación de e-NCF v1.0.md` | Proceso y estructura para invalidar comprobantes electrónicos. | Consultar para implementar lógica de anulación. |
| `Formato Aprobación Comercial v1.0.md` | Flujo y XML para la aceptación o rechazo comercial de facturas entre empresas. | Consultar para implementar flujos de aprobación/rechazo comercial. |
| `Formato Resumen Factura Consumo Electrónica v1.0.md` | Formato simplificado para el reporte de transacciones de consumo masivo. | Consultar para implementar el reporte diario de facturas de consumo. |

## Instrucciones Específicas
- **Búsqueda**: Si necesitas un campo específico del XML, ve directamente a `Formato Comprobante Fiscal Electrónico (e-CF) V1.0.md`.
- **Firma**: Para problemas de "Bad Signature" o configuración de certificados, lee `Firmado de e-CF.md`.
- **Errores**: Para interpretar un código de respuesta (ej. "60" o "75"), busca en `Informe Técnico e-CF v1.0.md`.
