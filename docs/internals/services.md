# Servicios (Services)

En la versión 2.0, el paquete ha consolidado sus servicios en una estructura más eficiente centrada en `DgiiService`. Este servicio actúa como el único punto de entrada para orquestar la lógica de negocio compleja.

## Características de DgiiService

- **Punto de Entrada Unificado:** A través del facade `Dgii`, se tiene acceso a todas las funcionalidades del servicio.
- **Orquestación de Acciones:** Delega tareas específicas a las `Actions` (firma, envío, validación, almacenamiento).
- **Gestión Automática de Autenticación:** Se encarga de manejar el flujo de Semilla -> Firma -> Token de forma transparente para el desarrollador.
- **Monitoreo de Infraestructura:** Incluye nuevos métodos para verificar el estado de los servidores de la DGII y ventanas de mantenimiento.

## Métodos Principales

### Facturación Electrónica (e-CF)
- `submitInvoice(array $data)`: Procesa el ciclo completo de una factura (Generación XML, Firma, Envío y Almacenamiento). Retorna un objeto `InvoiceData`.
- `validateInvoiceStatus(string $path, ?string $trackId)`: Consulta el estado de procesamiento de una factura previamente enviada.
- `sendInvoice(string $path)`: Permite enviar un XML ya firmado y almacenado.
- `receiveInvoice(string $token, string $signed)`: Envía a la DGII un XML ya firmado pasando directamente el token de autenticación.

### Documentos Especiales
- `sendCancellationRange(array $data)`: Gestiona la anulación de rangos de comprobantes (ANECF).
- `sendCommercialApproval(string $token, string $signedXml)`: Envía la aprobación comercial de documentos recibidos (ARECF/ACECF). Requiere un token de autenticación.

### Utilidades y Monitoreo
- `receiveSeed(string $signedXml)`: Intercambia una semilla ya firmada por un token de acceso.
- `requestSeed()`: Obtiene una nueva semilla de autenticación.
- `getServiceStatus()`: Verifica si los servicios web de la DGII están activos.
- `getMaintenanceWindows()`: Consulta las próximas paradas programadas de la DGII.
- `getEnvironmentStatus()`: Obtiene un resumen detallado del estado de los diferentes entornos (Test, Certificación, Producción).

## Ejemplo de Flujo Interno

Cuando llamas a `Dgii::submitInvoice()`, el servicio realiza lo siguiente internamente:

```php
public function submitInvoice(array $data): InvoiceData
{
    // 1. Firma el XML y genera el objeto InvoiceData inicial
    $invoiceData = $this->signInvoice->handle($data);
    
    // 2. Envía el XML firmado a la DGII (maneja auth automáticamente)
    $response = $this->submitInvoiceAction->handle($invoiceData);
    
    // 3. Persiste el XML y la respuesta en el almacenamiento configurado
    return $this->storageInvoice->handle($invoiceData);
    }
    ```

    ## Firma Digital (DgiiXml)

    Para casos donde se requiera interacción directa con el motor de firma sin pasar por el flujo de negocio de `DgiiService`, se proporciona el facade `DgiiXml`. Este facade es un wrapper sobre `XmlSigner`.

    ### Métodos Disponibles

    - `sign(string $xml, ?string $certPath = null, ?string $certPassword = null)`: Aplica una firma digital a un string XML. Si no se provee el certificado, utiliza el configurado en `dgii.php`.
    - `validateCertificate(?string $certPath = null, ?string $certPassword = null)`: Valida la integridad de un certificado digital y devuelve información sobre su validez y emisor.


Esta abstracción permite que la implementación en tu aplicación sea de una sola línea, manteniendo todo el poder de la arquitectura orientada a acciones.
