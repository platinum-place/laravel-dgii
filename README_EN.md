# Laravel DGII 🇩🇴

[![Latest Version on Packagist](https://img.shields.io/packagist/v/platinum-place/laravel-dgii.svg?style=flat-square)](https://packagist.org/packages/platinum-place/laravel-dgii)
[![Total Downloads](https://img.shields.io/packagist/dt/platinum-place/laravel-dgii.svg?style=flat-square)](https://packagist.org/packages/platinum-place/laravel-dgii)
[![GitHub License](https://img.shields.io/github/license/platinum-place/laravel-dgii.svg?style=flat-square)](LICENSE)

An elegant Laravel integration with the **General Directorate of Internal Taxes (DGII)** web services for managing **Electronic Fiscal Receipts (e-CF)**.

> [Leer en Español 🇪🇸](./README.md)

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

The package is designed to be used via Facades, hiding the complexity of internal Actions.

### Send an Invoice (e-CF)
```php
use PlatinumPlace\LaravelDgii\Facades\DgiiInvoice;

// Data follows the official DGII structure
$invoiceData = [...]; 

// Sign, store, and send in one step
$result = DgiiInvoice::send($invoiceData);

echo $result->invoiceReceived->getTrackId();
echo $result->qrLink;
```

### Range Cancellation (ANECF)
```php
use PlatinumPlace\LaravelDgii\Facades\DgiiCancellationRange;

$response = DgiiCancellationRange::send($data);
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
