<?php

namespace PlatinumPlace\LaravelDgii\Services;

use Exception;
use PlatinumPlace\LaravelDgii\Actions\Acknowledgment\GenerateAcknowledgmentAction;
use PlatinumPlace\LaravelDgii\Actions\Acknowledgment\SignAcknowledgmentAction;
use PlatinumPlace\LaravelDgii\Actions\Acknowledgment\StorageAcknowledgmentAction;
use PlatinumPlace\LaravelDgii\Actions\Invoice\CheckInvoiceStatusAction;
use PlatinumPlace\LaravelDgii\Actions\Invoice\GenerateConsumeInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\Invoice\GenerateInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\Invoice\GenerateInvoicePdfAction;
use PlatinumPlace\LaravelDgii\Actions\Invoice\GenerateInvoiceQrLinkAction;
use PlatinumPlace\LaravelDgii\Actions\Invoice\SendInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\Invoice\SignInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\Invoice\StorageInvoiceAction;
use PlatinumPlace\LaravelDgii\Data\InvoiceData;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceXml;

/**
 * Service to manage e-CF (Electronic Invoice) lifecycle operations.
 */
class DgiiInvoiceService
{
    /**
     * Create a new service instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Generate the official verification QR link (fiscal stamp) for an e-CF.
     *
     * @param  string  $xmlPath  Relative path of the stored signed XML file.
     * @param  string|null  $env  The environment to use.
     * @return string The full verification URL for the QR code.
     *
     * @throws Exception
     */
    public function getQrlInk(string $xmlPath, ?string $env = null): string
    {
        return app(GenerateInvoiceQrLinkAction::class)->handle($xmlPath, $env);
    }

    /**
     * Internal method to wrap stored XML objects into an InvoiceData DTO.
     *
     * @param  InvoiceXml  $invoiceXml  The main signed invoice XML.
     * @param  string|null  $env  The environment for QR generation.
     * @param  InvoiceXml|null  $integralInvoiceXml  The optional integral invoice XML.
     * @return InvoiceData The populated data transfer object.
     *
     * @throws Exception
     */
    private function returnStoredInvoiceData(InvoiceXml $invoiceXml, ?string $env = null, ?InvoiceXml $integralInvoiceXml = null): InvoiceData
    {
        [$invoiceXmlPath, $integralInvoiceXmlPath] = app(StorageInvoiceAction::class)->handle($invoiceXml, $integralInvoiceXml);

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
     * Store signed XML content into the configured storage and return its data.
     *
     * @param  string  $xmlContent  Signed main XML content.
     * @param  string|null  $env  The environment to use.
     * @param  string|null  $integralXmlContent  Optional signed integral XML content.
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

        return $this->returnStoredInvoiceData($invoiceXml, $env, $integralInvoiceXml);
    }

    /**
     * Generate, sign, and store an invoice from raw data.
     *
     * @param  array  $data  Template data for the invoice.
     * @param  string|null  $env  The environment to use.
     * @param  string|null  $certPath  Optional certificate path.
     * @param  string|null  $certPassword  Optional certificate password.
     * @return InvoiceData Invoice data with stored and signed invoice information.
     *
     * @throws Exception
     */
    public function sign(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        $invoiceXmlContent = app(GenerateInvoiceAction::class)->handle($data);

        $invoiceXml = app(SignInvoiceAction::class)->handle($invoiceXmlContent, $certPath, $certPassword);

        $integralInvoiceXml = null;

        if ($invoiceXml->isConsumeInvoice()) {
            $integralInvoiceXml = $invoiceXml;

            $invoiceXmlContent = app(GenerateConsumeInvoiceAction::class)->handle($invoiceXml, $data);

            $invoiceXml = app(SignInvoiceAction::class)->handle($invoiceXmlContent, $certPath, $certPassword);
        }

        return $this->returnStoredInvoiceData($invoiceXml, $env, $integralInvoiceXml);
    }

    /**
     * Internal orchestration to send the invoice and generate/store the acknowledgment.
     *
     * @param  InvoiceData  $invoiceData  The current transaction data.
     * @param  string|null  $env  The environment to use.
     * @param  string|null  $certPath  Optional certificate path for acknowledgment signing.
     * @param  string|null  $certPassword  Optional certificate password.
     * @param  string|null  $token  Optional authentication token.
     * @return InvoiceData The updated transaction data with response and acknowledgment.
     *
     * @throws Exception
     */
    private function returnInvoiceData(InvoiceData $invoiceData, ?string $env = null, ?string $certPath = null, ?string $certPassword = null, ?string $token = null): InvoiceData
    {
        $invoiceReceived = app(SendInvoiceAction::class)->handle($invoiceData, $env, $certPath, $certPassword, $token);

        $acknowledgmentXmlContent = app(GenerateAcknowledgmentAction::class)->handle($invoiceData->invoiceXml, $invoiceReceived);

        $signedAcknowledgmentXml = app(SignAcknowledgmentAction::class)->handle($acknowledgmentXmlContent, $certPath, $certPassword);

        $acknowledgmentXmlPath = app(StorageAcknowledgmentAction::class)->handle($signedAcknowledgmentXml);

        return new InvoiceData(
            $invoiceData->invoiceXml,
            $invoiceData->invoiceXmlPath,
            $invoiceData->qrLink,
            $invoiceData->integralInvoiceXml,
            $invoiceData->integralInvoiceXmlPath,
            $invoiceReceived,
            $signedAcknowledgmentXml,
            $acknowledgmentXmlPath
        );
    }

    /**
     * Send an invoice to DGII. Supports both raw data (array) or already signed XML (string).
     *
     * @param  string|array  $xmlContent  Raw data for generation or signed XML content.
     * @param  string|null  $env  The environment to use.
     * @param  string|null  $certPath  Optional certificate path.
     * @param  string|null  $certPassword  Optional certificate password.
     * @param  string|null  $token  Optional existing authentication token.
     * @return InvoiceData Complete transaction data including response and acknowledgment.
     *
     * @throws Exception
     */
    public function send(string|array $xmlContent, ?string $env = null, ?string $certPath = null, ?string $certPassword = null, ?string $token = null): InvoiceData
    {
        if (is_array($xmlContent)) {
            $invoiceData = $this->sign($xmlContent, $env, $certPath, $certPassword);
        } else {
            $invoiceData = $this->storage($xmlContent, $env);
        }

        return $this->returnInvoiceData($invoiceData, $env, $certPath, $certPassword, $token);
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
        $invoiceReceived = app(CheckInvoiceStatusAction::class)->handle($xmlPath, $trackId, $env, $certPath, $certPassword);

        return new InvoiceData(
            InvoiceXml::fromXmlPath($xmlPath),
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
     */
    public function generatePdf(string $xmlContent, string $qrLink, ?string $logo = null): string
    {
        return app(GenerateInvoicePdfAction::class)->handle($xmlContent, $qrLink, $logo);
    }

    /**
     * Re-submit an existing stored XML file to DGII.
     *
     * @param  string  $xmlPath  The relative path of the stored XML.
     * @param  string|null  $env  The environment to use.
     * @param  string|null  $certPath  Optional certificate path.
     * @param  string|null  $certPassword  Optional certificate password.
     * @return InvoiceData The transaction result with the new DGII response.
     *
     * @throws Exception
     */
    public function submit(string $xmlPath, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        $invoiceData = new InvoiceData(
            InvoiceXml::fromXmlPath($xmlPath),
            $xmlPath,
        );

        $invoiceReceived = app(SendInvoiceAction::class)->handle($invoiceData, $env, $certPath, $certPassword);

        return new InvoiceData(
            InvoiceXml::fromXmlPath($xmlPath),
            invoiceReceived: $invoiceReceived,
        );
    }
}
