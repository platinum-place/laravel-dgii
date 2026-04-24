# Estructuras de Datos DGII (Data Structures)

Esta guía detalla la estructura de los arrays de datos esperados por los servicios de este paquete para generar los documentos XML requeridos por la DGII. Las estructuras aquí descritas son una representación directa de las [Especificaciones Técnicas de la DGII](https://dgii.gov.do/cicloContribuyente/facturacion/comprobantesFiscalesElectronicosE-CF/Paginas/documentacionSobreE-CF.aspx).

---

## 1. Facturas Electrónicas (e-CF)
Utilizado por `DgiiInvoice::send()`. Soporta tipos 31, 32, 33, 34, 41, 43, 44, 45, 46 y 47.

### Encabezado (`IdDoc`)
| Campo | Descripción |
| :--- | :--- |
| `TipoeCF` | Tipo de comprobante (ej: 31). |
| `eNCF` | Número de Comprobante Fiscal Electrónico. |
| `FechaVencimientoSecuencia` | Fecha de vencimiento (DD-MM-AAAA). |
| `IndicadorMontoGravado` | (Opcional) 1 si incluye montos gravados. |
| `TipoIngresos` | Código de tipo de ingresos. |
| `TipoPago` | Código de forma de pago (1: Contado, 2: Crédito, etc.). |
| `TablaFormasPago` | Array de objetos con `FormaPago` y `MontoPago`. |

### Emisor (`Emisor`)
| Campo | Descripción |
| :--- | :--- |
| `RNCEmisor` | RNC o Cédula del emisor (11 o 9 dígitos). |
| `RazonSocialEmisor` | Nombre legal de la empresa. |
| `DireccionEmisor` | Dirección física. |
| `FechaEmision` | Fecha de emisión (DD-MM-AAAA). |

### Comprador (`Comprador`)
| Campo | Descripción |
| :--- | :--- |
| `RNCComprador` | RNC o Cédula del receptor. |
| `RazonSocialComprador` | Nombre legal del receptor. |

### Detalles de Items (`DetallesItems`)
Un array de items, cada uno con:
| Campo | Descripción |
| :--- | :--- |
| `NumeroLinea` | Secuencial de la línea. |
| `NombreItem` | Nombre del producto o servicio. |
| `CantidadItem` | Cantidad vendida. |
| `PrecioUnitarioItem` | Precio por unidad. |
| `MontoItem` | Precio unitario * Cantidad. |

---

## 2. Anulación de Rangos (ANECF)
Utilizado por `DgiiCancellationRange::send()`.

| Campo | Descripción |
| :--- | :--- |
| `RncEmisor` | RNC del contribuyente. |
| `CantidadeNCFAnulados` | Total de comprobantes anulados en la solicitud. |
| `DetalleAnulacion` | Array con `TipoeCF` y `TablaRangoSecuenciasAnuladaseNCF`. |

---

## 3. Aprobación Comercial (ARECF / ACECF)
Utilizado por `DgiiCommercialApproval::send()`.

### Acuse de Recibo (ARECF)
| Campo | Descripción |
| :--- | :--- |
| `RNCEmisor` | RNC de quien emitió la factura. |
| `RNCComprador` | RNC de quien recibe y aprueba/rechaza. |
| `eNCF` | e-NCF del documento. |
| `Estado` | `0` (Aceptado), `1` (Rechazado). |

### Aprobación Comercial (ACECF)
Similar a ARECF pero incluye:
| Campo | Descripción |
| :--- | :--- |
| `MontoTotal` | Monto total de la factura. |
| `FechaEmision` | Fecha de la factura. |

---

## Enlaces de Referencia Oficial
Para detalles técnicos exhaustivos sobre validaciones de campos y códigos de error, consulte los manuales originales:

*   **Portal Oficial e-CF:** [Documentación sobre e-CF](https://dgii.gov.do/cicloContribuyente/facturacion/comprobantesFiscalesElectronicosE-CF/Paginas/documentacionSobreE-CF.aspx)
*   **Guía Técnica:** Especificaciones de Formato XML y Web Services.
