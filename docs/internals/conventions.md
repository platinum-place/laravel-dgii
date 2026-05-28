# Convenciones del Proyecto y Guía del Colaborador (v1.3.7)

Este paquete mantiene estándares estrictos de desarrollo para asegurar que la integración con la DGII siga siendo rápida, mantenible, libre de estado (stateless) y fácil de extender por cualquier desarrollador.

---

## 📝 1. Reglas Generales de Código e Idioma

1. **Código Fuente en INGLÉS:**
   * Nombres de clases, métodos, variables, parámetros, namespaces, comentarios técnicos y docblocks deben estar redactados en inglés.
   * *Ejemplo:* `DgiiClient`, `DgiiXmlRender`, `$certContent`, `fetchAuthSeed`.
2. **Documentación en ESPAÑOL:**
   * Todos los manuales, archivos markdown (`.md`) y explicaciones dirigidas a usuarios y desarrolladores deben mantenerse en español (dado que el público objetivo es la República Dominicana).
3. **Estilo de Código:**
   * Se sigue rigurosamente el estándar **PSR-12**.
   * Es mandatorio formatear los archivos utilizando `Laravel Pint` antes de realizar cualquier commit.

---

## 🏗️ 2. Patrones Arquitectónicos de la v1.3.7

Para colaborar o agregar nuevas funciones en el paquete, debes seguir estrictamente los siguientes patrones de diseño:

### 2.1 Servicios y Métodos 100% Libres de Estado (Stateless Services)
Ningún servicio interno (`DgiiClient`, `DgiiXmlRender`) ni el propio gateway `DgiiService` deben almacenar datos dinámicos de forma persistente en memoria o depender de archivos de configuración globales para secretos que varían por cliente (ej: certificados, contraseñas de certificados o tokens de acceso).
* **Regla:** Pide los certificados, contraseñas y tokens de acceso siempre como argumentos de entrada en las firmas de los métodos.
* **Excepción:** La `API Key` para servicios de estatus y disponibilidad puede configurarse globalmente en el archivo `config/dgii.php` si es constante para toda la aplicación del usuario.
* **Razón:** Esto mantiene la compatibilidad y flexibilidad absoluta para aplicaciones multi-inquilino (multi-tenant) mientras simplifica el uso de servicios compartidos.

```php
// ❌ MALO: Depender de tokens dinámicos guardados en la configuración del paquete
public function sendInvoice(string $filePath): array
{
    $token = config('dgii.access_token'); // No hacer esto
}

// ✅ BUENO: Recibir el secreto dinámico por parámetro en el método
public function sendInvoice(string $env, string $token, string $filePath): array
{
    // Lógica pura sin estado
}
```

### 2.2 Uso Exclusivo de Datos Primitivos (`array` / `string` / `bool`)
Nunca crees clases DTO o respuestas customizadas (`InvoiceData`, `ResponseObject`). 
* **Regla:** Los métodos de renderizado deben retornar strings limpios (para XMLs firmados) o arrays asociativos nativos (`array`) para las respuestas parsed de los endpoints de la DGII.
* **Razón:** Facilita la manipulación y serialización directa de los datos en la aplicación del usuario sin obligar a mapear clases complejas del paquete.

### 2.3 Cero Capas de Abstracción Redundantes (No Repositorios, No Modelos)
No crees clases de repositorio abstractas ni interfaces redundantes. La comunicación HTTP debe realizarse directamente en `DgiiClient` usando el cliente HTTP de Laravel (`Http`) y sus macros.

---

## 🛠️ 3. ¿Cómo agregar una nueva funcionalidad?

Si necesitas integrar un nuevo servicio web de la DGII (por ejemplo, consultas especializadas de NCF o nuevos tipos de aprobaciones), sigue este flujo de desarrollo:

### Paso 1: Agregar el método en el Servicio Especializado correspondiente
* Si la nueva funcionalidad implica hacer una petición HTTP a la DGII, agrégala en `src/Services/DgiiClient.php` utilizando los macros HTTP del paquete:
```php
// En src/Services/DgiiClient.php

public function fetchNewFeature(string $env, string $token, string $someParameter): array
{
    $response = Http::dgiiInvoice($env)
        ->withToken($token)
        ->get(config('dgii.endpoints.new_feature.status'), [
            'parametro' => $someParameter,
        ]);

    return $response->json();
}
```
* Si implica generar y firmar digitalmente un nuevo XML, agrégala en `src/Services/DgiiXmlRender.php`.

### Paso 2: Exponer en el Gateway `DgiiService`
Expón el método correspondiente en `src/Services/DgiiService.php` para que sea accesible de forma directa y cómoda por los usuarios mediante el Facade unificado `Dgii`.

```php
// En src/Services/DgiiService.php

public function fetchNewFeature(string $env, string $token, string $someParameter): array
{
    return $this->client->fetchNewFeature($env, $token, $someParameter);
}
```

### Paso 3: Documentar
Añade la descripción del nuevo método, sus tipos de entrada y estructura de salida en **[Referencia del Facade](./facade.md)**.
