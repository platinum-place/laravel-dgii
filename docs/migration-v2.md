# Guía de Migración: de v1.x a v2.0

La versión 2.0 introduce cambios estructurales significativos para simplificar la API del paquete y mejorar la mantenibilidad. Esta guía te ayudará a actualizar tu integración.

## 1. Facades Unificados (Cambio más importante)

En la v1.x, existían múltiples facades para cada tipo de documento. En la v2.0, todos se han consolidado en el facade principal `Dgii`.

**Antes (v1.x):**
```php
use PlatinumPlace\LaravelDgii\Facades\DgiiInvoice;
use PlatinumPlace\LaravelDgii\Facades\DgiiCancellationRange;

$invoice = DgiiInvoice::send($data);
$cancellation = DgiiCancellationRange::send($data);
```

**Ahora (v2.0):**
```php
use PlatinumPlace\LaravelDgii\Facades\Dgii;

$invoice = Dgii::submitInvoice($data);
$cancellation = Dgii::sendCancellationRange($data);
```

### Tabla de Equivalencias de Métodos

| Acción | v1.x (Facade::metodo) | v2.0 (Dgii::metodo) |
| :--- | :--- | :--- |
| Enviar Factura | `DgiiInvoice::send()` | `Dgii::submitInvoice()` |
| Consultar Estatus | `DgiiInvoice::getStatus()` | `Dgii::validateInvoiceStatus()` |
| Anular Rango | `DgiiCancellationRange::send()` | `Dgii::sendCancellationRange()` |
| Aprobación Comercial | `DgiiCommercialApproval::send()` | `Dgii::sendCommercialApproval()` |
| Obtener Semilla | `DgiiSeed::get()` | `Dgii::requestSeed()` |
| Estatus de Servicios | `Dgii::getServiceStatus()` | `Dgii::getServiceStatus()` (Se mantiene) |

## 2. Cambios en Namespaces Internos

Si estabas extendiendo el paquete o utilizando clases internas directamente, ten en cuenta los siguientes cambios de ubicación:

- **Clients -> Repositories:** La capa de comunicación HTTP ahora se encuentra en `PlatinumPlace\LaravelDgii\Repositories`.
- **ValueObjects/DTOs -> Data:** Todos los objetos de transferencia de datos y representaciones XML ahora están bajo `PlatinumPlace\LaravelDgii\Data`.
- **Actions:** Se han eliminado los sub-directorios dentro de `Actions/`. Todas las acciones ahora residen directamente en el namespace raíz de acciones.

## 3. Respuestas Enriquecidas

El método `Dgii::submitInvoice()` (antiguo `send()`) ahora devuelve un objeto `InvoiceData` que contiene no solo la respuesta de la DGII, sino también el XML firmado, la ruta de almacenamiento y el enlace QR si aplica.

```php
$data = Dgii::submitInvoice($arrayData);

// Acceder a la respuesta (InvoiceReceived)
$response = $data->response; 

// Acceder al XML firmado
$xmlContent = $data->xml->content;

// Acceder al enlace QR
$qr = $data->qrLink;
```

## 4. Nuevos Métodos de Monitoreo

La v2.0 añade métodos para consultar el estado detallado de los entornos de la DGII:

```php
$maintenance = Dgii::getMaintenanceWindows();
$envStatus = Dgii::getEnvironmentStatus();
```

---

Si tienes problemas con la migración, por favor abre un *Issue* en el repositorio de GitHub.
