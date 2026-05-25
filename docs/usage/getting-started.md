# Primeros Pasos con Laravel DGII

Esta guía te ayudará a instalar y comenzar a utilizar el paquete **Laravel DGII** bajo su diseño estable, minimalista y sin estado (stateless).

---

## 🛠️ Instalación

Puedes instalar el paquete a través de Composer en tu proyecto Laravel:

```bash
composer require platinum-place/laravel-dgii
```

Opcionalmente, puedes publicar el archivo de configuración si deseas modificar los dominios de los servidores web de la DGII o los nombres de los endpoints oficiales:

```bash
php artisan vendor:publish --tag=dgii-config
```

---

## ⚙️ Configuración (Sin Secretos en el Paquete)

El paquete **no guarda contraseñas, certificados ni llaves de API en su archivo de configuración**. Esto te otorga un control total sobre cómo almacenas y administras estos datos sensibles (por ejemplo, encriptados en tu base de datos o en servicios de Vault).

Solo debes configurar las variables de entorno en tu `.env` si los servidores web oficiales cambiaran:

```env
# Por defecto se asume la configuración oficial de la DGII
DGII_DOMAIN_INVOICE=https://ecf.dgii.gov.do
DGII_DOMAIN_CONSUME_INVOICE=https://fc.dgii.gov.do
DGII_DOMAIN_STATUS=https://statusecf.dgii.gov.do
```

---

## 🚀 Flujo de Trabajo Básico (Workflow)

Debido a que el paquete es **stateless**, todas las credenciales, llaves de acceso y entornos se suministran en cada llamada. A continuación se presenta el flujo completo de integración para emitir un e-CF:

### Paso 1: Autenticación (Obtener Token)

Para comunicarte con los servicios web de facturación e-CF, necesitas un token de acceso temporal. Este se obtiene intercambiando una semilla firmada:

```php
use PlatinumPlace\LaravelDgii\Facades\Dgii;

// 1. Obtener la semilla XML limpia desde la DGII indicando el ambiente
$seedXml = Dgii::getSeed('testecf'); // testecf (sandbox), certecf (certificación), ecf (producción)

// 2. Firmar la semilla digitalmente
$certContent = file_get_contents('/ruta/al/certificado.p12');
$certPassword = 'tu_contraseña_del_certificado';

$signedSeedXml = (new \PlatinumPlace\DgiiXmlSigner\SignManager)
    ->sign($certContent, $certPassword, $seedXml);

// 3. Guardar temporalmente en un archivo para adjuntarlo
$tempSeedFile = tempnam(sys_get_temp_dir(), 'seed');
file_put_contents($tempSeedFile, $signedSeedXml);

// 4. Intercambiar semilla firmada por el Access Token (indicando ambiente y archivo)
$authResponse = Dgii::verifySeed('testecf', $tempSeedFile);
$accessToken = $authResponse['token']; // Token temporal válido por 24 horas

@unlink($tempSeedFile);
```

### Paso 2: Generar y Firmar el Comprobante (e-CF)

Genera el XML de la factura. Puedes proveer tu propio XML o usar las plantillas Blade del paquete:

```php
use PlatinumPlace\LaravelDgii\Facades\Dgii;

$invoiceData = [
    'IdDoc' => [
        'TipoeCF' => 31,
        'eNCF' => 'E310000000001',
        'FechaEmision' => '24-05-2026',
        // ... resto de campos requeridos por la DGII
    ],
    'Emisor' => [...],
    'Comprador' => [...],
    'DetallesItems' => [...]
];

// Renders y firmas el XML en un solo paso
$invoiceResult = Dgii::renderInvoice($certContent, $certPassword, $invoiceData);

// El resultado contiene el 'xml' firmado y opcionalmente el XML 'integral' para consumo
$signedInvoiceXml = $invoiceResult['xml'];

// Guarda el XML firmado en tu base de datos o almacenamiento físico
$invoiceFilePath = '/ruta/a/facturas/E310000000001.xml';
file_put_contents($invoiceFilePath, $signedInvoiceXml);
```

### Paso 3: Enviar y Rastrear e-CF

Con el token de acceso obtenido en el Paso 1 y el XML firmado del Paso 2, realiza el envío y obtén el estatus:

```php
use PlatinumPlace\LaravelDgii\Facades\Dgii;

// 1. Subir la factura a la DGII (ambiente, token y ruta)
$sendResult = Dgii::sendInvoice('testecf', $accessToken, $invoiceFilePath);
$trackId = $sendResult['trackId'];

// 2. Consultar el estatus de procesamiento (ambiente, token y trackId)
$statusResult = Dgii::findInvoice('testecf', $accessToken, $trackId);

if ($statusResult['status'] === 'Aceptado') {
    echo "¡Comprobante procesado exitosamente!";
} else {
    echo "Fallo en procesamiento: " . json_encode($statusResult);
}
```

---

## 📚 Siguientes Pasos

* **[Estructuras de Datos](./data-structures.md)** - Conoce la estructura de arrays esperada para las plantillas XML dinámicas.
* **[Catálogo de Acciones](../internals/actions.md)** - Lista detallada de todas las acciones.
