# Acciones (Actions)

Las Acciones representan la lógica de negocio atómica y reutilizable del paquete. En la versión 2.0, las acciones se organizan por **Dominios** y **Roles** para garantizar una estructura escalable y fácil de navegar.

## Características de las Acciones

- **Responsabilidad Única:** Cada acción realiza una tarea puntual (ej. `SignInvoiceAction` solo orquesta la firma).
- **Organización por Roles:**
  - **Orchestrators:** Coordinan múltiples pasos o servicios para completar una tarea de negocio.
  - **Mappers:** Se encargan exclusivamente de la transformación de datos (ej. de Array a XML).
- **Inyección por Contenedor:** Son instanciadas automáticamente por Laravel.
- **Interoperabilidad:** Todas trabajan con objetos del namespace `Data` para garantizar la consistencia de los datos.

## Lista de Acciones Disponibles

A continuación se detallan las acciones principales organizadas por dominio:

### Facturación (`src/Actions/Invoices/`)
- `SignInvoiceAction`: Orquesta la generación del XML y su firma digital.
- `SignXmlInvoiceAction`: Orquesta la firma digital de un XML ya generado.
- `SubmitInvoiceAction`: Gestiona el ciclo completo: firma, almacenamiento y envío a la DGII.
- `ReceiveInvoiceAction`: Gestiona el envío a la DGII de un documento ya firmado.
- `ValidateInvoiceStatusAction`: Consulta el estatus de procesamiento usando el `trackId`.
- `SendInvoiceAction`: Envía un archivo XML ya firmado y almacenado previamente.
- `StorageInvoiceAction`: Persiste los archivos y respuestas en el `StorageRepository`.
- `ResolveInvoiceQrLinkAction`: Genera el enlace oficial del código QR para el e-CF.

### Criptografía y Certificados (`src/Actions/Xmls/`)
- `SignXmlAction`: Acción de bajo nivel para la firma digital de strings XML.
- `ValidateCertificateAction`: Verifica la validez y extrae información del certificado configurado.

### Otros Documentos
- `SubmitCancellationRangeAction`: Procesa el envío de anulación de rangos (ANECF).
- `SubmitCommercialApprovalAction`: Procesa el envío de aprobaciones comerciales (ARECF/ACECF).
- `ProcessAcknowledgmentAction`: Maneja la generación y procesamiento de acuses de recibo.

### Autenticación y Semillas
- `ReceiveSeedAction`: Gestiona el intercambio de la semilla firmada por un token de acceso.
- `ResolveAccessToken`: Recupera o genera un token válido para las peticiones a la DGII.

## Beneficios de la Nueva Estructura

1.  **Escalabilidad:** La separación por dominios evita que la carpeta `Actions` se sature de archivos no relacionados.
2.  **Claridad Intencional:** Al separar `Orchestrators` de `Mappers`, es evidente qué acciones contienen lógica de flujo y cuáles solo transformación.
3.  **Mantenibilidad:** Facilita la localización de errores y la implementación de pruebas unitarias específicas para cada rol.

## Ejemplo de Uso Manual

Si deseas usar una acción de forma independiente al servicio principal:

```php
use PlatinumPlace\LaravelDgii\Actions\Invoices\Orchestrators\SignInvoiceAction;

public function sign(SignInvoiceAction $signInvoice, array $data)
{
    // La acción se encarga de resolver las dependencias necesarias
    $invoiceData = $signInvoice->handle($data);
    // ...
}
```
