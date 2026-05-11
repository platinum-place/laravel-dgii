# Acciones (Actions)

Las Acciones representan la lógica de negocio atómica y reutilizable del paquete. En la versión 2.0, la estructura de directorios se ha aplanado para facilitar el acceso y la inyección de dependencias.

## Características de las Acciones

- **Responsabilidad Única:** Cada acción realiza una tarea puntual (ej. `SignInvoiceAction` solo firma).
- **Inyección por Contenedor:** Son instanciadas automáticamente por Laravel.
- **Interoperabilidad:** Todas trabajan con objetos del namespace `Data` para garantizar la consistencia de los datos.

## Lista de Acciones Disponibles

A continuación se detallan las acciones principales disponibles en `src/Actions/`:

### Facturación (Invoice)
- `SignInvoiceAction`: Genera el XML desde un array de datos y realiza la firma digital.
- `SubmitInvoiceAction`: Gestiona la autenticación y el envío del XML firmado a la DGII.
- `ReceiveInvoiceAction`: Gestiona el envío a la DGII de un XML ya firmado previamente.
- `ValidateInvoiceStatusAction`: Consulta el estatus de procesamiento de un documento usando su `trackId`.
- `SendInvoiceAction`: Toma un archivo XML ya firmado y almacenado y lo envía a la DGII.
- `StorageInvoiceAction`: Persiste los archivos XML y las respuestas de la DGII en el repositorio de almacenamiento.

### Otros Documentos
- `SubmitCancellationRangeAction`: Procesa el envío de solicitudes de anulación de rangos (ANECF).
- `SubmitCommercialApprovalAction`: Procesa el envío de aprobaciones comerciales (ARECF/ACECF).
- `ProcessAcknowledgmentAction`: Maneja la lógica para generar y procesar acuses de recibo.

### Utilidades
- `ReceiveSeedAction`: Gestiona la recepción de una semilla firmada y su intercambio por un token.
- `ValidateInvoiceStatusAction`: Consulta el estatus de un e-CF enviado previamente.

## Beneficios de la Nueva Estructura

1.  **Descubribilidad:** Al estar todas las acciones en un solo nivel, es más fácil identificar qué herramientas ofrece el paquete.
2.  **Mantenibilidad:** Menos niveles de directorios reducen la complejidad de los namespaces y las importaciones.
3.  **Flexibilidad:** Puedes inyectar cualquier acción directamente en tus propios controladores o comandos de Artisan si necesitas un comportamiento personalizado fuera de `DgiiService`.

## Ejemplo de Uso Manual

Si deseas usar una acción de forma independiente al servicio principal:

```php
use PlatinumPlace\LaravelDgii\Actions\SignInvoiceAction;

public function sign(SignInvoiceAction $signInvoice, InvoiceXml $invoice)
{
    $signedXml = $signInvoice->handle($invoice);
    // ...
}
```
