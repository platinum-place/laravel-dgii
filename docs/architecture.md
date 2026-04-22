# Arquitectura del Proyecto

Este paquete sigue una arquitectura moderna orientada a servicios y acciones, diseñada para ser modular, testeable y fácil de usar dentro del ecosistema de Laravel.

## Capas del Sistema

La interacción con el paquete fluye a través de las siguientes capas:

1.  **Facades:** Son la interfaz pública y estática que el desarrollador utiliza (ej. `DgiiInvoice::send()`). Proporcionan una sintaxis limpia y expresiva.
2.  **Services:** Actúan como orquestadores de alto nivel. Cada servicio (ej. `DgiiInvoiceService`) agrupa lógica de negocio compleja que requiere la ejecución de múltiples pasos técnicos.
3.  **Actions:** Son clases con una única responsabilidad (`handle()`). Cada acción realiza una tarea atómica y específica, como firmar un XML, enviar una petición HTTP o guardar un archivo.
4.  **Clients:** Encapsulan las llamadas a los servicios web de la DGII utilizando el cliente HTTP de Laravel.
5.  **Value Objects & DTOs:** Estructuran los datos que fluyen entre las capas, garantizando integridad y tipado fuerte.

## Flujo de Trabajo (Workflow)

Cuando el usuario invoca un método desde un **Facade**:
1.  El Facade resuelve el **Service** correspondiente desde el contenedor de Laravel.
2.  El Service recibe la solicitud y comienza a orquestar las **Actions** necesarias.
3.  Por ejemplo, al enviar una factura:
    *   Se ejecuta `SignInvoiceAction` para firmar digitalmente el documento.
    2.  Se invoca `SendInvoiceAction`, que evalúa el tipo de factura y delega el envío a `SendStandardInvoiceAction` o `SendConsumeInvoiceAction` a través de sus respectivos clientes (`InvoiceClient` o `ConsumeInvoiceClient`).
    *   Se usa `StorageInvoiceAction` para persistir el XML firmado en el disco configurado.
4.  El Service devuelve una respuesta estructurada al usuario final.

Esta separación de responsabilidades permite que cada componente sea probado de forma aislada y que el código sea fácil de mantener y extender.
