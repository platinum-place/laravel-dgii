# Acciones (Actions)

Las Acciones representan la lógica de negocio atómica y reutilizable del paquete. Cada acción tiene una única responsabilidad (SRP), lo que facilita su mantenimiento, testing e inyección en diferentes partes del sistema.

## Características de las Acciones

- **Responsabilidad Única:** Cada acción realiza una tarea puntual. Por ejemplo, `SignInvoiceAction` solo firma un XML y no se encarga de enviarlo.
- **Inyección por Contenedor:** Son instanciadas y resueltas automáticamente por el contenedor de dependencias de Laravel.
- **Método handle():** Todas las acciones exponen un método principal (usualmente llamado `handle()`) que ejecuta su lógica.

## Clasificación de Acciones

Las acciones se organizan en sub-namespaces según el área de negocio a la que pertenecen:

### Generales (General)
- `AuthenticateAction`: Gestiona la autenticación con la DGII y el almacenamiento en caché de tokens.
- `ValidateCertAction`: Valida que el certificado digital exista y la contraseña sea correcta.

### Invoice (Facturación)
- `SignInvoiceAction`: Realiza la firma digital del XML de la factura.
- `SendInvoiceAction`: Orquestador que delega el envío a `SendStandardInvoiceAction` o `SendConsumeInvoiceAction`.
- `SendStandardInvoiceAction`: Envía facturas electrónicas estándar a la DGII.
- `SendConsumeInvoiceAction`: Envía resúmenes de facturas de consumo (RFCE) a la DGII.
- `ValidateInvoiceAction`: Orquestador que delega la validación de estatus a `ValidateStandardInvoiceAction` o `ValidateConsumeInvoiceAction`.
- `ValidateStandardInvoiceAction`: Consulta el estatus de facturas estándar enviadas.
- `ValidateConsumeInvoiceAction`: Consulta el estatus de resúmenes de consumo enviados.
- `StorageInvoiceAction`: Persiste el archivo XML y los datos de respuesta en disco.

### Seed (Semilla)
- `ReceiveSeedAction`: Gestiona la obtención y procesamiento inicial de la semilla para autenticación.

### Acknowledgment (Aceptación/Acuse)
- `GenerateAcknowledgmentAction`: Crea el XML de acuse de recibo requerido por la DGII.
- `SignAcknowledgmentAction`: Firma digitalmente el acuse de recibo.

### Cancellation Range (Anulaciones)
- `GenerateCancellationRangeAction`: Crea el XML de solicitud de anulación.
- `SendCancellationRangeAction`: Envía la solicitud a los servidores de la DGII.

### Commercial Approval (Aprobación Comercial)
- `SendCommercialApprovalAction`: Envía la aprobación comercial de un e-CF recibido.

## Beneficios del uso de Actions

1.  **Reutilización:** Una misma acción (ej. `AuthenticateAction`) puede ser utilizada por múltiples servicios.
2.  **Mantenibilidad:** Si cambian los requisitos de firma de la DGII, solo es necesario modificar `SignInvoiceAction`.
3.  **Testabilidad:** Es extremadamente sencillo escribir pruebas unitarias para cada acción de forma aislada.
4.  **Desacoplamiento:** Los servicios no necesitan saber *cómo* se firma una factura, solo llaman a la acción encargada de hacerlo.
