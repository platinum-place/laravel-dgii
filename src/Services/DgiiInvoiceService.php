<?php

namespace PlatinumPlace\LaravelDgii\Services;

use Exception;
use PlatinumPlace\LaravelDgii\Actions\Acknowledgment\GenerateAcknowledgmentAction;
use PlatinumPlace\LaravelDgii\Actions\Acknowledgment\SignAcknowledgmentAction;
use PlatinumPlace\LaravelDgii\Actions\Acknowledgment\StorageAcknowledgmentAction;
use PlatinumPlace\LaravelDgii\Actions\Invoice\GenerateInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\Invoice\GenerateInvoicePdfAction;
use PlatinumPlace\LaravelDgii\Actions\Invoice\SignInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\Invoice\StorageInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\ValidateCertAction;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceData;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\Repositories\InvoiceRepository;

/**
 * Service to manage e-CF (Electronic Invoice) lifecycle operations.
 */
class DgiiInvoiceService
{
    /**
     * Create a new service instance.
     */
    public function __construct(
        protected InvoiceRepository            $invoiceRepository,
        protected StorageInvoiceAction         $storageInvoiceAction,
        protected ValidateCertAction           $validateCertAction,
        protected GenerateInvoiceAction        $generateInvoiceAction,
        protected SignInvoiceAction            $signInvoiceAction,
        protected GenerateAcknowledgmentAction $generateAcknowledgmentAction,
        protected SignAcknowledgmentAction     $signAcknowledgmentAction,
        protected StorageAcknowledgmentAction  $storageAcknowledgmentAction,
        protected GenerateInvoicePdfAction     $generateInvoicePdfAction
    )
    {
    }

    /**
     * Generate the official verification QR link (fiscal stamp) for an e-CF.
     *
     * @param string $xmlPath Relative path of the stored signed XML file.
     * @param string|null $env The environment to use.
     * @return string The full verification URL for the QR code.
     *
     * @throws Exception
     */
    public function getQrlInk(string $xmlPath, ?string $env = null): string
    {
        return $this->invoiceRepository->getQRLink($xmlPath, $env);
    }

    /**
     * Store signed XML content into the configured storage and return its data.
     *
     * @param string $xmlContent Signed main XML content.
     * @param string|null $env The environment to use.
     * @param string|null $integralXmlContent Optional signed integral XML content.
     * @return InvoiceData Data object containing stored paths and QR link.
     *
     * @throws Exception
     */
    public function storage(string $xmlContent, ?string $env = null, ?string $integralXmlContent = null): InvoiceData
    {
        $invoiceXml = new InvoiceXml($xmlContent);

        $integralInvoiceXml = null;

        if ($integralXmlContent) {
            $integralInvoiceXml = new InvoiceXml($integralXmlContent);
        }

        [$invoiceXmlPath, $integralInvoiceXmlPath] = $this->storageInvoiceAction->handle($invoiceXml, $integralInvoiceXml);

        $qrLink = $this->getQrlInk($invoiceXmlPath, $env);

        return new InvoiceData(
            $invoiceXml,
            $invoiceXmlPath,
            $qrLink,
            $integralInvoiceXml,
            $integralInvoiceXmlPath
        );
    }

    /**
     * Generate, sign, and store an invoice from raw data.
     *
     * @param array $data Template data for the invoice.
     * @param string|null $env The environment to use.
     * @param string|null $certPath Optional certificate path.
     * @param string|null $certPassword Optional certificate password.
     * @return InvoiceData Invoice data with stored and signed invoice information.
     *
     * @throws Exception
     */
    public function sign(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        $this->validateCertAction->handle($certPath, $certPassword);

        $invoiceXmlContent = $this->generateInvoiceAction->handle($data);

        [$invoiceXml, $integralInvoiceXml] = $this->signInvoiceAction->handle($invoiceXmlContent, $data, $certPath, $certPassword);

        [$invoiceXmlPath, $integralInvoiceXmlPath] = $this->storageInvoiceAction->handle($invoiceXml, $integralInvoiceXml);

        $qrLink = $this->getQrlInk($invoiceXmlPath, $env);

        return new InvoiceData(
            $invoiceXml,
            $invoiceXmlPath,
            $qrLink,
            $integralInvoiceXml,
            $integralInvoiceXmlPath
        );
    }

    /**
     * Re-submit an existing stored XML file to DGII.
     *
     * @param string $xmlPath The relative path of the stored XML.
     * @param string|null $env The environment to use.
     * @param string|null $certPath Optional certificate path.
     * @param string|null $certPassword Optional certificate password.
     * @return InvoiceData The transaction result with the new DGII response.
     *
     * @throws Exception
     */
    public function submit(string $xmlPath, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        $this->validateCertAction->handle($certPath, $certPassword);

        $invoiceReceived = $this->invoiceRepository->send($xmlPath, $env, $certPath, $certPassword);

        return new InvoiceData(
            InvoiceXml::fromXmlPath($xmlPath),
            $xmlPath,
            invoiceReceived: $invoiceReceived,
        );
    }

    /**
     * Send an invoice to DGII. Supports both raw data (array) or already signed XML (string).
     *
     * @param string|array $xmlContent Raw data for generation or signed XML content.
     * @param string|null $env The environment to use.
     * @param string|null $certPath Optional certificate path.
     * @param string|null $certPassword Optional certificate password.
     * @param string|null $token Optional existing authentication token.
     * @return InvoiceData Complete transaction data including response and acknowledgment.
     *
     * @throws Exception
     */
    public function send(string|array $xmlContent, ?string $env = null, ?string $certPath = null, ?string $certPassword = null, ?string $token = null): InvoiceData
    {
        $this->validateCertAction->handle($certPath, $certPassword);

        if (is_array($xmlContent)) {
            $invoiceXmlContent = $this->generateInvoiceAction->handle($xmlContent);

            [$invoiceXml, $integralInvoiceXml] = $this->signInvoiceAction->handle($invoiceXmlContent, $xmlContent, $certPath, $certPassword);

            [$invoiceXmlPath, $integralInvoiceXmlPath] = $this->storageInvoiceAction->handle($invoiceXml, $integralInvoiceXml);
        } else {
            $integralInvoiceXml = null;

            $invoiceXml = new InvoiceXml($xmlContent);

            [$invoiceXmlPath, $integralInvoiceXmlPath] = $this->storageInvoiceAction->handle($invoiceXml);
        }

        $invoiceReceived = $this->invoiceRepository->send($invoiceXmlPath, $env, $certPath, $certPassword, $token);

        $acknowledgmentXmlContent = $this->generateAcknowledgmentAction->handle($invoiceXml, $invoiceReceived);

        $signedAcknowledgmentXml = $this->signAcknowledgmentAction->handle($acknowledgmentXmlContent, $certPath, $certPassword);

        $acknowledgmentXmlPath = $this->storageAcknowledgmentAction->handle($signedAcknowledgmentXml);

        $qrLink = $this->getQrlInk($invoiceXmlPath, $env);

        return new InvoiceData(
            $invoiceXml,
            $invoiceXmlPath,
            $qrLink,
            $integralInvoiceXml,
            $integralInvoiceXmlPath,
            $invoiceReceived,
            $signedAcknowledgmentXml,
            $acknowledgmentXmlPath
        );
    }

    /**
     * Check the status of a previously sent invoice.
     *
     * @param  string  $xmlPath  Relative path of the XML in storage.
     * @param  string|null  $trackId  Tracking ID from a previous submission.
     * @param  string|null  $env  The environment to use.
     * @param  string|null  $certPath  Optional certificate path.
     * @param  string|null  $certPassword  Optional certificate password.
     * @return InvoiceData Current status of the invoice.
     *
     * @throws Exception
     */
    public function checkStatus(string $xmlPath, ?string $trackId = null, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        $this->validateCertAction->handle($certPath, $certPassword);

        $invoiceReceived = $this->invoiceRepository->getByXml($xmlPath, $trackId, $env, $certPath, $certPassword);

        return new InvoiceData(
            InvoiceXml::fromXmlPath($xmlPath),
            $xmlPath,
            invoiceReceived: $invoiceReceived,
        );
    }

    /**
     * Generate the PDF representation (Representación Impresa) for an e-CF.
     *
     * @param  string  $xmlContent  The signed XML content to include in the PDF.
     * @param  string  $qrLink  The full verification URL for the QR code.
     * @param  string|null  $logo  Binary logo content or null.
     * @return string The raw binary content of the generated PDF.
     *
     * @throws Exception
     */
    public function generatePdf(string $xmlContent, string $qrLink, ?string $logo = null): string
    {
        return $this->generateInvoicePdfAction->handle($xmlContent, $qrLink, $logo);
    }
}
