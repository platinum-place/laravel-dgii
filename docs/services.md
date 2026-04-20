# Servicios (Services)

Los Servicios en este paquete son orquestadores de alto nivel. Su función principal es agrupar lógica de negocio compleja que requiere la interacción de múltiples capas del sistema (Acciones, Clientes, Storage) y presentar una interfaz sencilla y unificada para el usuario final.

## Características de los Servicios

- **Orquestación:** No realizan lógica atómica por sí mismos, sino que delegan en `Actions`.
- **Inyección de Dependencias:** Utilizan el contenedor de servicios de Laravel para recibir las acciones necesarias en su constructor.
- **Flujos de Trabajo (Workflows):** Un solo método de un servicio puede involucrar autenticación automática, firma de documentos, envío a la DGII y persistencia en disco.

## Principales Servicios Disponibles

A continuación se detallan los servicios clave y sus responsabilidades:

1.  **DgiiInvoiceService:** Gestiona todo el ciclo de vida de los e-CF (Facturas Electrónicas).
    - Orquesta la firma digital de facturas.
    - Maneja el envío y la consulta de estatus en la DGII.
    - Genera representaciones impresas (PDF) y enlaces QR.

2.  **DgiiSeedService:** Responsable de la obtención de la "Semilla" (Seed) necesaria para el proceso de autenticación con la DGII.

3.  **DgiiCancellationRangeService:** Gestiona las anulaciones de rangos de comprobantes fiscales electrónicos.

4.  **DgiiCommercialApprovalService:** Maneja la aprobación comercial de documentos recibidos.

5.  **DgiiService:** Servicio base que proporciona funcionalidades transversales, como la autenticación automática y la obtención de tokens válidos para interactuar con los servicios web de la DGII.

## Ejemplo de Implementación

Internamente, un servicio se ve así:

```php
public function sendInvoice(InvoiceData $data): InvoiceReceived
{
    // 1. Firmar el XML
    $signedXml = $this->signInvoiceAction->handle($data);
    
    // 2. Enviar a la DGII
    $response = $this->sendInvoiceAction->handle($signedXml);
    
    // 3. Persistir en disco
    $this->storageInvoiceAction->handle($signedXml, $response);

    return $response;
}
```

Los servicios garantizan que el desarrollador no necesite conocer los detalles técnicos de cada paso, permitiendo una integración rápida y segura.
