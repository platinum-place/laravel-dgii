# Changelog

All notable changes to `laravel-dgii` will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.1.2] - 2026-05-13

### Added
- Added `getResponse()` method to `InvoiceResponse`, `CommercialApprovalResponse`, and `CancellationRangeResponse` to allow access to the raw API response.

## [2.1.1] - 2026-05-13

### Changed
- Added `@throws` annotations and improved DocBlocks across actions and services for better developer experience and static analysis.

## [2.1.0] - 2026-05-12

### Changed
- **BREAKING CHANGE:** Organized the `Actions/` directory by domains (`Invoices`, `Auth`, `Xmls`, etc.) and roles (`Orchestrators`, `Mappers`) for better scalability.
- **BREAKING CHANGE:** Simplified Repository names by removing the `Dgii` prefix (e.g., `InvoiceRepository`, `ApiRepository`).
- Renamed the internal `XmlSigner` service to `XmlService` (accessed via `DgiiXml` facade) to reflect its broader role in certificate validation and XML management.
- Updated all internal references and documentation to match the new naming conventions and structure.

### Fixed
- Corrected a bug in `AcknowledgmentXml` where it was trying to access an undefined `xmlSigner` property instead of `xml`.

## [2.0.14] - 2026-05-12

### Fixed
- Update endpoint configuration in `DgiiQrResolver` to use 'qr' instead of 'timbre'.

### Refactored
- Rename `AcknowledgmentXmlParse` to `AcknowledgmentXmlParser` and update all internal references.

### Changed
- Remove outdated services documentation and update references across README files.

## [2.0.13] - 2026-05-12

### Changed
- Restructure documentation directory for better clarity and organization.

## [2.0.12] - 2026-05-11

### Fixed
- Automatically update `FechaHoraFirma` in `SignXmlInvoiceAction` before signing to ensure time consistency.

## [2.0.11] - 2026-05-11

### Added
- New `SignXmlInvoiceAction` to allow signing raw XML invoice content directly.
- Added `signXmlInvoice` method to `DgiiService` and `Dgii` facade.
- Registered the new action in the package documentation.


### Fixed
- Corrected the token key in `DgiiAuthenticator` from `access_token` to `token` to match the DGII API response.
- Updated authentication-related DocBlocks to reflect the correct JSON key for tokens.

## [2.0.9] - 2026-05-10

### Added
- New specialized exceptions in the `Exceptions/` namespace for granular error handling in Repositories.

### Changed
- All Repositories now throw specific exceptions when the DGII API returns null or invalid JSON responses.

## [2.0.8] - 2026-05-10

### Added
- New `exists()` method to `StorageRepository` to check for file existence on the configured disk.

### Changed
- Improved robustness in `SendInvoiceAction`, `ValidateInvoiceStatusAction`, and `XmlSigner` by adding explicit file existence checks before processing.
- `XmlSigner` now throws clear `InvalidArgumentException` when the certificate file is missing.

## [2.0.7] - 2026-05-10

### Changed
- XML files are now saved using their semantic name (RNC + Sequence) instead of random UUIDs, improving file organization and traceability.
- Updated all storage actions (`SignInvoiceAction`, `ReceiveInvoiceAction`, etc.) to leverage the `getXmlName()` method.

## [2.0.6] - 2026-05-10

### Changed
- Improved `ReceiveInvoiceAction` to include QR link generation.
- Simplified `ReceiveInvoiceAction` dependencies and removed unused trait.

## [2.0.0] - 2026-05-10

### Added
- New unified architecture centered on the `Dgii` facade and `DgiiService`.
- Specialized facade `DgiiXml` for direct XML signing and certificate validation.
- Repository layer (`Repositories/`) replacing the old specialized clients.
- Centralized data structures in the `Data/` namespace, unifying DTOs, XML objects, and Responses.
- Support for maintenance windows and environment status checks via `DgiiService`.
- Improved response wrapping and error handling via `DgiiResponseWrapper`.

### Changed
- **BREAKING CHANGE:** Consolidated all service facades (`DgiiInvoice`, `DgiiCancellationRange`, etc.) into a single `Dgii` facade.
- **BREAKING CHANGE:** Renamed service methods to be more consistent (e.g., `DgiiInvoice::send()` is now `Dgii::submitInvoice()`).
- **BREAKING CHANGE:** Flattened the `Actions/` directory structure, removing sub-namespaces.
- **BREAKING CHANGE:** The `Clients/` namespace has been removed in favor of `Repositories/`.
- Updated all internal logic to use the new `InvoiceData` lifecycle DTO.

### Removed
- Specialized facades: `DgiiInvoice`, `DgiiSeed`, `DgiiCancellationRange`, `DgiiCommercialApproval`.
- Specialized clients from the `Clients/` namespace.

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
