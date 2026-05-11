# Primeros Pasos con Laravel DGII

Bienvenido a la guía de inicio rápido para el paquete **Laravel DGII**. Esta guía te ayudará a instalar y configurar el paquete para comenzar a emitir Comprobantes Fiscales Electrónicos (e-CF) rápidamente.

## 🛠️ Instalación

Puedes instalar el paquete a través de Composer:

```bash
composer require platinum-place/laravel-dgii
```

Luego, publica el archivo de configuración:

```bash
php artisan vendor:publish --tag=dgii-config
```

## ⚙️ Configuración

Añade las siguientes variables a tu archivo `.env`:

```env
DGII_ENVIRONMENT=testecf # testecf, certecf o ecf
DGII_CERT_PATH=storage/dgii/certs/tu_certificado.p12
DGII_KEY_PASSWORD=tu_password_del_certificado
DGII_API_KEY=tu_api_key_de_la_dgii
```

## 🚀 Uso Básico

El paquete utiliza el Facade `Dgii` para simplificar la mayoría de las operaciones.

### Enviar una Factura

```php
use PlatinumPlace\LaravelDgii\Facades\Dgii;

$invoiceData = [
    // Datos de la factura siguiendo la estructura de la DGII
];

$result = Dgii::submitInvoice($invoiceData);

if ($result->isSuccess()) {
    echo "Factura enviada. TrackId: " . $result->response->getTrackId();
}
```

## 📚 Siguientes Pasos

- **[Estructuras de Datos](./data-structures.md)**: Conoce el formato de datos requerido para cada documento.
- **[Guía de Migración](./migration-v2.md)**: Si vienes de la versión 1.x, lee esto primero.
- **[Arquitectura Interna](../internals/architecture.md)**: Para entender cómo funciona el paquete por dentro.
