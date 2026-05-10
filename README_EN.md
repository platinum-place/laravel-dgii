# Laravel DGII 🇩🇴

[![Latest Version on Packagist](https://img.shields.io/packagist/v/platinum-place/laravel-dgii.svg?style=flat-square)](https://packagist.org/packages/platinum-place/laravel-dgii)
[![Total Downloads](https://img.shields.io/packagist/dt/platinum-place/laravel-dgii.svg?style=flat-square)](https://packagist.org/packages/platinum-place/laravel-dgii)
[![GitHub License](https://img.shields.io/github/license/platinum-place/laravel-dgii.svg?style=flat-square)](LICENSE)

An elegant Laravel integration with the **General Directorate of Internal Taxes (DGII)** web services for managing **Electronic Fiscal Receipts (e-CF)**.

> [Leer en Español 🇪🇸](./README.md) | **[Migration Guide v1 to v2](./docs/migration-v2.md)**

---

## 🚀 Key Features

- **Digital Signature:** Automatic XML signing using `.p12` / `.pfx` certificates.
- **Robust Validation:** Preventive certificate validation before signing or submission.
- **Smart Authentication:** Automatic management of seeds and tokens with integrated caching.
- **Full e-CF Lifecycle:** Generation, signing, submission, and status inquiry for electronic invoices.
- **Extended Support:** Tax credit (31), consumption (32), credit notes (33), and more.
- **Special Documents:** Commercial approval (ARECF) and sequence range cancellation (ANECF).
---

## 📦 Core Dependencies

This package relies on robust community solutions:

- **XML Signature:** `platinum-place/php-dgii-xml-signer`
- **HTTP Client:** Guzzle (via Laravel HTTP Facade)

---

## 📖 Documentation

Complete index of resources to master the DGII integration:

- **[Migration Guide (v1 to v2.0)](./docs/migration-v2.md)** - **Required reading for existing users.**
- [System Architecture](./docs/architecture.md) - Understand the Repositories, Data, and Actions layers.
- [Data Structures (e-CF)](./docs/dgii-data-structures.md) - Field details for each document type.
- [Services and Methods](./docs/services.md) - Guide to `DgiiService` and monitoring.
- [Actions Catalog](./docs/actions.md) - List of available atomic actions.
- [Project Conventions](./docs/conventions.md) - Code and language standards.
- [Official DGII Documentation](https://dgii.gov.do/cicloContribuyente/facturacion/comprobantesFiscalesElectronicosE-CF/Paginas/documentacionSobreE-CF.aspx) - Legal and technical manuals.

## 🛠️ Installation

```bash
composer require platinum-place/laravel-dgii
php artisan vendor:publish --tag=dgii-config
```

Configure your credentials in the `.env` file:

```env
DGII_ENVIRONMENT=testecf
DGII_CERT_PATH=storage/dgii/certs/my_certificate.p12
DGII_KEY_PASSWORD=your_password
DGII_API_KEY=your_api_key
```

---

## 📖 Quick Usage (via Facades)

The package uses a single `Dgii` Facade for all main operations.

### Send an Invoice (e-CF)
```php
use PlatinumPlace\LaravelDgii\Facades\Dgii;

// Data follows the official DGII structure
$invoiceData = [...]; 

// Sign, store, and send in one step
$result = Dgii::submitInvoice($invoiceData);

// The result is an InvoiceData object with all lifecycle information
echo $result->response->getTrackId();
echo $result->qrLink;
```

### Range Cancellation (ANECF)
```php
use PlatinumPlace\LaravelDgii\Facades\Dgii;

$response = Dgii::sendCancellationRange($data);
```

### Query Service Status
```php
use PlatinumPlace\LaravelDgii\Facades\Dgii;

$status = Dgii::getServiceStatus();
```

---

## 🙋‍♂️ Support and Consulting

If you need technical assistance with the implementation of this package or have general questions about the **Electronic Invoicing ecosystem in the Dominican Republic**, feel free to contact me.

I offer specialized consulting services for companies seeking to certify their systems with the DGII.

- **Contact:** My updated contact methods are available on my **[GitHub Profile](https://github.com/warlyn)**.
- **Issues:** For package bugs, please open an issue in this repository.

---

## ⚖️ License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.
