# Convenciones del Proyecto y Guía del Colaborador (v2.2)

Este paquete mantiene estándares estrictos de desarrollo para asegurar que la integración con la DGII siga siendo rápida, mantenible, libre de estado (stateless) y fácil de extender por cualquier desarrollador.

---

## 📝 1. Reglas Generales de Código e Idioma

1. **Código Fuente en INGLÉS:**
   * Nombres de clases, métodos, variables, parámetros, namespaces, comentarios técnicos y docblocks deben estar redactados en inglés.
   * *Ejemplo:* `RenderInvoiceXmlAction`, `FetchAuthSeedAction`, `$certContent`.
2. **Documentación en ESPAÑOL:**
   * Todos los manuales, archivos markdown (`.md`) y explicaciones dirigidas a usuarios y desarrolladores deben mantenerse en español (dado que el público objetivo es la República Dominicana).
3. **Estilo de Código:**
   * Se sigue rigurosamente el estándar **PSR-12**.
   * Es mandatorio formatear los archivos utilizando `Laravel Pint` antes de realizar cualquier commit.

---

## 🏗️ 2. Patrones Arquitectónicos de la v2.2
# Convenciones del Proyecto y Guía del Colaborador (v2.3)

...

### 2.1 Acciones 100% Libres de Estado (Stateless Actions)
Ninguna clase de acción (`Action`) debe depender de archivos de configuración globales para datos dinámicos o sensibles que varían por cliente (ej: certificados, contraseñas de certificados o tokens de acceso).
* **Regla:** Pide los certificados, contraseñas y tokens de acceso siempre como argumentos de entrada en el método `handle()`.
* **Excepción:** La `API Key` para servicios de estatus y disponibilidad puede configurarse globalmente en el archivo `config/dgii.php` si es constante para toda la aplicación.
* **Razón:** Esto mantiene la flexibilidad para aplicaciones multi-inquilino mientras simplifica el uso de servicios compartidos.

```php
// ❌ MALO: Depender de tokens dinámicos de la configuración
public function handle(string $filePath): array
{
    $token = config('dgii.access_token'); // No hacer esto
}

//  BUENO: Recibir el secreto dinámico por parámetro
public function handle(string $token, string $filePath): array
{
    // Lógica pura
}
```
### 2.2 Uso Exclusivo de Datos Primitivos (`array` / `string` / `bool`)
Nunca crees clases DTO o respuestas customizadas (`InvoiceData`, `ResponseObject`). 
* **Regla:** Las acciones deben retornar strings limpios (para XMLs) o arrays asociativos nativos (`array`) para las respuestas parsed de los web services.
* **Razón:** Facilita la manipulación y serialización directa de los datos en la aplicación del usuario sin obligar a mapear clases del paquete.

### 2.3 Cero Capas de Abstracción Redundantes (No Repositorios, No Modelos)
No crees clases de repositorio abstractas ni interfaces redundantes. La comunicación HTTP debe realizarse directamente en la Acción usando el cliente HTTP de Laravel (`Http`) y sus macros.

---

## 🛠️ 3. ¿Cómo agregar una nueva funcionalidad?

Si necesitas integrar un nuevo servicio web de la DGII (por ejemplo, consultas especializadas de NCF o nuevos tipos de aprobaciones), sigue este flujo de desarrollo:

### Paso 1: Crear la Acción Atómica
Crea una clase Action en `src/Actions/` con una única responsabilidad (`handle()`) e inyéctale dependencias nativas si las requiere en su constructor.
```php
namespace PlatinumPlace\LaravelDgii\Actions;

use Illuminate\Support\Facades\Http;

class SendNewFeatureAction
{
    public function handle(string $env, string $token, string $filePath): array
    {
        $response = Http::dgiiInvoice($env)
            ->withToken($token)
            ->attachXml($filePath)
            ->post(config('dgii.endpoints.new_feature.send'));

        return $response->json();
    }
}
```

### Paso 2: Exponer en el Gateway `DgiiService`
Inyecta tu nueva acción en el constructor de `src/DgiiService.php` y expone un método limpio para que sea accesible de forma directa y cómoda por los usuarios mediante el Facade `Dgii`.

```php
// En src/DgiiService.php

public function __construct(
    // ...
    protected SendNewFeatureAction $sendNewFeature,
) {}

public function sendNewFeature(string $token, string $filePath, ?string $env = null): array
{
    return $this->sendNewFeature->handle($env ?: config('dgii.environment'), $token, $filePath);
}
```

### Paso 3: Documentar
Añade la descripción de la nueva acción y sus tipos de entrada y salida en `docs/internals/actions.md`.
