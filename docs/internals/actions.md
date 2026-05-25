# Catálogo de Acciones (Actions)

Las Acciones representan la lógica de negocio atómica del paquete. Cada acción tiene una única responsabilidad y es inyectada automáticamente por el contenedor de Laravel en `DgiiService`.

Todas las acciones devuelven estructuras de datos primitivas (`array`, `string`, `bool`) para otorgar la máxima interoperabilidad y simplificar su consumo.

---

## Acciones Disponibles (`src/Actions/`)

### 1. Semillas y Autenticación
* **`FetchAuthSeedAction`**:
  * *Propósito:* Obtiene la semilla XML limpia desde los servidores de la DGII.
  * *Entrada:* `string $env`
  * *Salida:* `string` (XML de la semilla)
* **`SendAuthSeedAction`**:
  * *Propósito:* Envía la semilla firmada para validar y obtener el token de acceso.
  * *Entrada:* `string $env, string $filePath` (ruta al XML de la semilla firmada)
  * *Salida:* `array` (Token e información de expiración)

### 2. Facturación e-CF
* **`RenderInvoiceXmlAction`**:
  * *Propósito:* Renderiza la plantilla Blade del e-CF e integra la firma digital PKCS#12.
  * *Entrada:* `string $certContent, string $certPassword, array $data`
  * *Salida:* `string` (XML firmado)
* **`SendInvoiceAction`**:
  * *Propósito:* Realiza la petición POST de subida del e-CF firmado a la DGII.
  * *Entrada:* `string $env, string $token, string $filePath`
  * *Salida:* `array` (Estado del envío y `trackId`)
* **`FindInvoiceAction`**:
  * *Propósito:* Consulta el estatus de un e-CF mediante su `trackId`.
  * *Entrada:* `string $env, string $token, string $trackId`
  * *Salida:* `array` (Estatus oficial del procesamiento)
* **`FetchInvoicesAction`**:
  * *Propósito:* Obtiene los trackIds asociados a un RNC emisor y secuencia de e-CF.
  * *Entrada:* `string $env, string $token, string $senderIdentification, string $sequenceNumber`
  * *Salida:* `array` (Historial de trackIds y estatus)

### 3. Facturas de Consumo
* **`RenderConsumerInvoiceXmlAction`**:
  * *Propósito:* Renderiza y firma el e-CF de consumo. Extrae y calcula el código de seguridad e-CF de forma automática.
  * *Entrada:* `string $certContent, string $certPassword, array $data`
  * *Salida:* `array` (Contiene el XML firmado y el XML integral)
* **`SendConsumerInvoiceAction`**:
  * *Propósito:* Envía facturas de consumo al endpoint especializado de la DGII (`recepcionfc`).
  * *Entrada:* `string $env, string $token, string $filePath`
  * *Salida:* `array` (Respuesta oficial del procesamiento)
* **`FetchConsumerInvoiceAction`**:
  * *Propósito:* Consulta el estatus de facturas de consumo usando RNC, secuencia y código de seguridad.
  * *Entrada:* `string $env, string $token, string $senderIdentification, string $sequenceNumber, string $securityCode`
  * *Salida:* `array` (Respuesta oficial de consulta)

### 4. Anulación de Rangos
* **`RenderCancellationRangeXmlAction`**:
  * *Propósito:* Renderiza y firma la solicitud de anulación de rangos (ANECF).
  * *Entrada:* `string $certContent, string $certPassword, array $data`
  * *Salida:* `string` (XML firmado)
* **`SendCancellationRangeAction`**:
  * *Propósito:* Envía la solicitud firmada al endpoint de anulación de rangos.
  * *Entrada:* `string $env, string $token, string $filePath`
  * *Salida:* `array` (Confirmación del estatus de anulación)

### 5. Aprobaciones Comerciales
* **`SendCommercialApprovalAction`**:
  * *Propósito:* Envía respuestas de aceptación comercial firmadas (ARECF/ACECF).
  * *Entrada:* `string $env, string $token, string $filePath`
  * *Salida:* `array` (Confirmación del estatus de aprobación)

### 6. Acuses de Recibo
* **`RenderAcknowledgmentXmlAction`**:
  * *Propósito:* Genera y firma acuses de recibo para e-CF.
  * *Entrada:* `string $certContent, string $certPassword, string $senderIdentification, string $buyerIdentification, string $sequenceNumber, string $status, ?string $notReceivedCode = null`
  * *Salida:* `string` (XML firmado)

### 7. Disponibilidad DGII
* **`FetchServiceStatusAction`**:
  * *Propósito:* Consulta la disponibilidad general de los servicios de la DGII.
  * *Entrada:* `string $apiKey`
  * *Salida:* `array` (Estado de cada servicio)
* **`FetchMaintenanceWindowsAction`**:
  * *Propósito:* Obtiene las ventanas de mantenimiento programadas.
  * *Entrada:* `string $apiKey`
  * *Salida:* `array`
* **`FetchEnvironmentStatusAction`**:
  * *Propósito:* Comprueba la disponibilidad de un ambiente específico (sandbox, certificación o producción).
  * *Entrada:* `string $apiKey, string $env`
  * *Salida:* `array`
