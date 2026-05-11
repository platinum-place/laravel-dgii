# Arquitectura del Proyecto (v2.0)

Este paquete sigue una arquitectura moderna orientada a servicios y acciones, diseñada para ser modular, testeable y fácil de usar dentro del ecosistema de Laravel.

## Capas del Sistema

La interacción con el paquete fluye a través de las siguientes capas:

1.  **Facades:** El facade unificado `Dgii` es la interfaz pública principal para servicios web. Se incluye también `DgiiXml` para la gestión directa de firmas digitales y certificados.
2.  **Services:** `DgiiService` actúa como el orquestador central para procesos de negocio. `XmlSigner` (detrás de `DgiiXml`) se encarga de la lógica técnica de criptografía.
3.  **Actions:** Son clases con una única responsabilidad (`handle()`). Realizan tareas atómicas como firmar un XML (`SignInvoiceAction`) o persistir archivos (`StorageInvoiceAction`). En la v2.0, estas acciones se han simplificado y aplanado estructuralmente.
4.  **Repositories:** Encapsulan las llamadas a los servicios web de la DGII y la interacción con el almacenamiento, reemplazando la antigua capa de "Clients".
5.  **Data (DTOs & XML):** Centraliza la estructura de los datos que fluyen entre las capas, incluyendo objetos XML (`InvoiceXml`) y respuestas de la API (`InvoiceReceived`), garantizando integridad y tipado fuerte.

## Flujo de Trabajo (Workflow)

Cuando el usuario invoca un método desde el **Facade `Dgii`**:
1.  El Facade resuelve `DgiiService` desde el contenedor de Laravel.
2.  El Service recibe la solicitud y orquesta las **Actions** necesarias.
3.  Por ejemplo, al ejecutar `Dgii::submitInvoice($data)`:
    *   Se ejecuta `SignInvoiceAction` para generar y firmar digitalmente el XML.
    *   Se utiliza `DgiiInvoiceRepository` para realizar la petición HTTP post-autenticación.
    *   Se usa `StorageInvoiceAction` (vía `StorageRepository`) para persistir el XML firmado en el disco.
4.  El Service devuelve un objeto `InvoiceData` que contiene el estado completo del ciclo de vida del documento.

Esta separación de responsabilidades permite que cada componente sea probado de forma aislada y que el código sea fácil de mantener y extender.
