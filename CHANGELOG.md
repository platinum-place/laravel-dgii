# Changelog

All notable changes to `laravel-dgii` will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.3.3] - 2026-05-25

### Added
- **Intelligent Invoice Routing:** Added `rules` configuration to `config/dgii.php` to define `consumer_invoice_type` and `consumer_invoice_limit`.
- Implemented automatic redirection in `renderInvoice` to use `renderConsumerInvoiceXml` when the document matches consumer criteria.

### Changed
- Updated `renderInvoice` return type from `string` to `array` (containing `xml` and `integral` keys) to maintain consistency with consumer invoice outputs.

### Removed
- Removed `renderConsumerInvoice` method from `DgiiService` as its functionality is now unified within `renderInvoice`.

## [1.3.2] - 2026-05-24

### Added
- **Stateless Domain-Action Architecture:** Rewrote the package from the ground up to follow a stateless, caller-driven design under the v1.x line.
- Organized actions into 7 clear business domains: `Seeds`, `Invoices`, `ConsumerInvoices`, `CancellationRanges`, `CommercialApprovals`, `Acknowledgments`, and `Dgii`.
- Implemented a unified `DgiiService` gateway and static `Dgii` facade, receiving `$env` as a required first parameter.
- Returned primitive types (`array`, `string`) across all gateway operations, discarding rigid DTOs and repositories.
- Deleted outdated configurations, cache wrappers, and local storage persistence to give full control to the user.

## [1.3.1] - 2026-04-24

### Added
- Comprehensive technical documentation for DGII services and internal data structures in `docs/`.

### Changed
- Removed `ext-gd` requirement from `composer.json` as it is no longer needed after PDF removal.

## [1.3.0] - 2026-04-23

### Removed
- `GenerateInvoicePdfAction` and `dompdf` / `simple-qrcode` dependencies.
- PDF generation support from `DgiiInvoiceService`.
- `invoice-template` Blade view.

## [1.2.0] - 2026-04-20

### Added
- New Data Transfer Object architecture (`InvoiceData`, `CancellationRangeData`, `CommercialApprovalData`).
- Full lifecycle support for Acknowledgment (Acuse de Recibo) of e-CF.
- Specialized Actions for Acknowledgment: `GenerateAcknowledgmentAction`, `SignAcknowledgmentAction`, `StorageAcknowledgmentAction`.
- `ConsumeInvoiceClient` for specialized invoice consumption services.
- Improved documentation and code examples in README.

### Changed
- Refactored Actions into sub-namespaces (`Invoice`, `Acknowledgment`, `CancellationRange`, `CommercialApproval`, `Seed`).
- Updated `InvoiceData` structure to provide direct access to `qrLink` and other lifecycle fields.

## [1.1.0] - 2026-04-14

### Added
- Testing suite with PHPUnit and Orchestra Testbench.
- GitHub Actions CI workflow.
- Comprehensive DocBlocks for all Actions, ValueObjects, Services, and Helpers.
- Contributing guide and improved README documentation.
- Validation and exception handling in InvoiceXml constructor.

### Fixed
- Authentication logic in AuthenticateAction.
- Service Provider asset publishing.

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
