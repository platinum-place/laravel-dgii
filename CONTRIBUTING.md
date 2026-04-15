# Contributing to Laravel DGII

Thank you for considering contributing to the Laravel DGII package! We welcome all contributions that help improve this integration with the Dominican Republic's tax authority (DGII).

## Code of Conduct

Please be respectful and professional in all your interactions within this project.

## How Can I Contribute?

### Reporting Bugs
If you find a bug, please open an issue and include:
- A clear description of the problem.
- Steps to reproduce the issue.
- Your PHP and Laravel versions.
- Any relevant XML examples (be sure to redact sensitive information like RNCs or names if necessary).

### Pull Requests
1. Fork the repository and create your branch from `main`.
2. If you've added code that should be tested, add tests.
3. Ensure the test suite passes (`composer test`).
4. Format your code using Laravel Pint (`./vendor/bin/pint`).
5. Ensure static analysis passes (`./vendor/bin/phpstan analyze`).
6. Update the documentation if you've changed or added functionality.
7. Open a Pull Request with a clear title and description of your changes.

## Development Standards

- **PSR Standards:** We follow PSR-12 and Laravel's coding style.
- **Actions:** Logic should be encapsulated in Action classes whenever possible.
- **Type Hinting:** Use strict typing and return type hints in all new methods.
- **Commit Messages:** Follow the [Conventional Commits](https://www.conventionalcommits.org/) specification.

## Security Vulnerabilities

If you discover a security vulnerability, please email support@platinumplace.do. Do not open a public issue.
