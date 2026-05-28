# Referencia del Facade `Dgii` y Gateway Service (v1.3.7)

Toda la funcionalidad pública de este paquete se expone a través del Facade estático `PlatinumPlace\LaravelDgii\Facades\Dgii`, el cual redirige dinámicamente las llamadas al Gateway `DgiiService` (`src/Services/DgiiService.php`).

Debido al diseño **100% libre de estado (stateless)** de esta versión, todos los secretos, credenciales, entornos y tokens deben ser suministrados como parámetros en cada llamada. Todos los métodos retornan tipos de datos primitivos (`array` o `string`) y arrojan excepciones estándar en caso de fallos.

---

## 🚀 Métodos Disponibles

### 1. Semillas y Autenticación

#### 🔹 `Dgii::getSeed(string $env): string`
* **Descripción:** Obtiene la semilla XML limpia desde los servidores de la DGII.
* **Parámetros:**
  * `$env`: Código del ambiente de red (`testecf` para sandbox, `certecf` para certificación, `ecf` para producción).
* **Retorno:** `string` (El XML de la semilla en texto plano).
* **Excepciones:** `Illuminate\Http\Client\ConnectionException` si la llamada de red falla.

#### 🔹 `Dgii::verifySeed(string $env, string $filePath): array`
* **Descripción:** Envía la semilla firmada digitalmente para validar y obtener el token de acceso oficial.
* **Parámetros:**
  * `$env`: Código del ambiente de red.
  * `$filePath`: Ruta absoluta local al archivo XML de la semilla firmada digitalmente.
* **Retorno:** `array` (Respuesta JSON de la DGII decodificada, conteniendo el token e información de expiración).
* **Excepciones:** `Illuminate\Http\Client\ConnectionException`.

#### 🔹 `Dgii::renderSeed(string $value, string $date): string`
* **Descripción:** Renderiza localmente el XML de una semilla utilizando la plantilla Blade interna.
* **Parámetros:**
  * `$value`: Valor numérico/alfanumérico de la semilla provista.
  * `$date`: Fecha y hora de generación (formato DGII).
* **Retorno:** `string` (XML limpio sin firmar listo para ser procesado por el SignManager).
* **Excepciones:** `Throwable` en caso de fallas en el motor Blade.

---

### 2. Generación y Firma de e-CF (Firma Digital)

#### 🔹 `Dgii::renderInvoice(string $certContent, string $certPassword, array $data): array`
* **Descripción:** Renderiza y aplica la firma digital PKCS#12 a un Comprobante Fiscal Electrónico (e-CF). Este método es inteligente: detecta de forma automática si la factura califica como Factura de Consumo (tipo `31` y monto inferior al límite configurado en `config/dgii.php`) y en ese caso redirige la renderización al formato especializado, calculando y adjuntando el código de seguridad de consumo de forma automática.
* **Parámetros:**
  * `$certContent`: Contenido crudo del archivo de certificado digital `.p12` (leído por ejemplo con `file_get_contents`).
  * `$certPassword`: Contraseña del certificado digital.
  * `$data`: Estructura del comprobante en formato `array` asociativo.
* **Retorno:** `array` estructurado con las siguientes llaves:
  * `xml`: El documento XML principal firmado digitalmente (listo para enviar).
  * `integral`: (Solo para facturas de consumo que califiquen) El XML completo original sin simplificar, útil para almacenamiento interno. Para facturas estándar, este valor es `null`.
* **Excepciones:** `Throwable` si el certificado es inválido, la contraseña es incorrecta o hay errores de sintaxis XML.

#### 🔹 `Dgii::renderCancellationRange(string $certContent, string $certPassword, array $data): string`
* **Descripción:** Renderiza y firma digitalmente una solicitud de anulación de rango de comprobantes electrónicos (ANECF).
* **Parámetros:**
  * `$certContent`: Contenido crudo del certificado `.p12`.
  * `$certPassword`: Contraseña del certificado.
  * `$data`: Datos del rango a anular en formato de `array`.
* **Retorno:** `string` (El XML firmado digitalmente de la anulación).
* **Excepciones:** `Throwable`.

#### 🔹 `Dgii::renderAcknowledgment(string $certContent, string $certPassword, string $senderIdentification, string $buyerIdentification, string $sequenceNumber, string $status, ?string $notReceivedCode = null): string`
* **Descripción:** Renderiza y firma un Acuse de Recibo técnico de e-CF (ARECF) para aceptación o rechazo técnico de comprobantes recibidos de otros contribuyentes.
* **Parámetros:**
  * `$certContent`: Contenido crudo del certificado `.p12`.
  * `$certPassword`: Contraseña del certificado.
  * `$senderIdentification`: RNC o Cédula del emisor original de la factura.
  * `$buyerIdentification`: RNC o Cédula de tu empresa (receptora).
  * `$sequenceNumber`: Secuencia e-NCF del documento.
  * `$status`: Estado (`0` para Recibido Conforme, `1` para Recibido Con Discrepancia, etc.).
  * `$notReceivedCode`: (Opcional) Código del motivo de rechazo/discrepancia.
* **Retorno:** `string` (El XML firmado del acuse de recibo).
* **Excepciones:** `Throwable`.

---

### 3. Envío y Consultas e-CF (Servicios Web de Facturación)

#### 🔹 `Dgii::sendInvoice(string $env, string $token, string $filePath): array`
* **Descripción:** Realiza la subida de un e-CF firmado digitalmente a la DGII.
* **Parámetros:**
  * `$env`: Código del ambiente de red.
  * `$token`: Access token temporal vigente obtenido en la autenticación.
  * `$filePath`: Ruta absoluta local al archivo XML del e-CF firmado.
* **Retorno:** `array` (Respuesta JSON de la DGII decodificada, típicamente con el estatus y el `trackId` generado).
* **Excepciones:** `Illuminate\Http\Client\ConnectionException`.

#### 🔹 `Dgii::findInvoice(string $env, string $token, string $trackId): array`
* **Descripción:** Consulta el estatus de procesamiento oficial de un e-CF utilizando su `trackId`.
* **Parámetros:**
  * `$env`: Código del ambiente de red.
  * `$token`: Access token temporal.
  * `$trackId`: Identificador único de envío obtenido al subir la factura.
* **Retorno:** `array` (Estado del procesamiento y detalles de aceptación o errores del validador de la DGII).
* **Excepciones:** `Illuminate\Http\Client\ConnectionException`.

#### 🔹 `Dgii::fetchInvoices(string $env, string $token, string $senderIdentification, string $sequenceNumber): array`
* **Descripción:** Consulta el historial o disponibilidad de trackIds para un RNC emisor y una secuencia específica.
* **Parámetros:**
  * `$env`: Código del ambiente de red.
  * `$token`: Access token temporal.
  * `$senderIdentification`: RNC del emisor.
  * `$sequenceNumber`: Número de secuencia del e-CF.
* **Retorno:** `array` (Historial oficial de procesamiento de la secuencia).
* **Excepciones:** `Illuminate\Http\Client\ConnectionException`.

---

### 4. Flujos Especializados de Consumo y Comercial

#### 🔹 `Dgii::sendConsumerInvoice(string $env, string $token, string $filePath): array`
* **Descripción:** Envía un resumen firmado de facturas de consumo (RFCE) al endpoint especializado de la DGII (`recepcionfc`).
* **Parámetros:**
  * `$env`: Código del ambiente de red.
  * `$token`: Access token temporal.
  * `$filePath`: Ruta absoluta local al archivo XML del resumen firmado.
* **Retorno:** `array` (Confirmación oficial de recepción y procesamiento).
* **Excepciones:** `Illuminate\Http\Client\ConnectionException`.

#### 🔹 `Dgii::fetchConsumerInvoice(string $env, string $token, string $senderIdentification, string $sequenceNumber, string $securityCode): array`
* **Descripción:** Consulta el estatus de un e-CF de consumo usando la identificación del emisor, secuencia y el código de seguridad e-CF.
* **Parámetros:**
  * `$env`: Código del ambiente de red.
  * `$token`: Access token temporal.
  * `$senderIdentification`: RNC del emisor.
  * `$sequenceNumber`: Número de secuencia del e-CF.
  * `$securityCode`: Código de seguridad de 6 caracteres (extraído de la firma digital original).
* **Retorno:** `array`.
* **Excepciones:** `Illuminate\Http\Client\ConnectionException`.

#### 🔹 `Dgii::sendCancellationRange(string $env, string $token, string $filePath): array`
* **Descripción:** Envía la solicitud firmada de anulación de rango (ANECF) a la DGII.
* **Parámetros:**
  * `$env`: Código del ambiente de red.
  * `$token`: Access token temporal.
  * `$filePath`: Ruta absoluta local al archivo XML firmado del ANECF.
* **Retorno:** `array`.
* **Excepciones:** `Illuminate\Http\Client\ConnectionException`.

#### 🔹 `Dgii::sendCommercialApproval(string $env, string $token, string $filePath): array`
* **Descripción:** Envía un documento de aprobación comercial firmado digitalmente (ACECF) a los servidores de la DGII.
* **Parámetros:**
  * `$env`: Código del ambiente de red.
  * `$token`: Access token temporal.
  * `$filePath`: Ruta absoluta local al archivo XML firmado.
* **Retorno:** `array`.
* **Excepciones:** `Illuminate\Http\Client\ConnectionException`.

---

### 5. Disponibilidad y Diagnóstico de Servidores DGII

Estos métodos consultan los servicios de disponibilidad general. Requieren que la `DGII_API_KEY` esté configurada en el entorno o en `config/dgii.php`.

#### 🔹 `Dgii::getServiceStatus(): array`
* **Descripción:** Consulta la disponibilidad general y tiempos de respuesta de cada uno de los servicios web de la DGII.
* **Retorno:** `array` (Detalle por servicio web: habilitado, degradado, caído).
* **Excepciones:** `Illuminate\Http\Client\ConnectionException`.

#### 🔹 `Dgii::getMaintenanceWindows(): array`
* **Descripción:** Consulta el listado de ventanas de mantenimiento programadas publicadas por la DGII.
* **Retorno:** `array` (Fechas y horarios de mantenimientos programados).
* **Excepciones:** `Illuminate\Http\Client\ConnectionException`.

#### 🔹 `Dgii::getEnvironmentStatus(string $env): array`
* **Descripción:** Verifica la salud de un entorno de red específico de la DGII.
* **Parámetros:**
  * `$env`: El identificador de ambiente (`testecf`, `certecf` o `ecf`).
* **Retorno:** `array` (Detalle del estado del ambiente consultado).
* **Excepciones:** `Illuminate\Http\Client\ConnectionException`.
