# Changelog

All notable changes to `laravel-dgii` will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.26] - 2026-04-14

### Added
- Architectural overview to README.
- Docblocks for core Actions.
- New automated authentication flow.
- Usage examples for Action-based workflow.

## [1.0.25] - 2026-04-14

### Added
- Support for PDF and QR code generation for fiscal invoices.
- New `invoice-template` Blade view for PDF rendering.

## [1.0.24] - 2026-04-14

### Added
- `withoutSignature()` method to `InvoiceXml` to allow XML processing without digital signatures.

## [1.0.0] - 2026-04-10

### Added
- Initial release of the Laravel DGII package.
- Support for e-CF 31, 32, 33, 41, and more.
- Digital signature with `php-dgii-xml-signer`.
- Automatic authentication and token management.
