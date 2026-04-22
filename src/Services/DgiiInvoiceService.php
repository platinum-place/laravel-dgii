<?php

namespace PlatinumPlace\LaravelDgii\Services;

use Exception;
use PlatinumPlace\LaravelDgii\Actions\Acknowledgment\GenerateAcknowledgmentAction;
use PlatinumPlace\LaravelDgii\Actions\Acknowledgment\SignAcknowledgmentAction;
use PlatinumPlace\LaravelDgii\Actions\Acknowledgment\StorageAcknowledgmentAction;
use PlatinumPlace\LaravelDgii\Actions\Invoice\GenerateInvoicePdfAction;
use PlatinumPlace\LaravelDgii\Actions\Invoice\GenerateInvoiceQrAction;
use PlatinumPlace\LaravelDgii\Actions\Invoice\SendInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\Invoice\SignInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\Invoice\StorageInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\Invoice\ValidateInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\ValidateCertAction;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceData;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceReceived;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\Data\Invoice\SignedInvoice;

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
        return app(GenerateInvoiceQrAction::class)->handle($xmlPath, $env);
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

        $signedInvoice = new SignedInvoice($invoiceXml, $integralInvoiceXml);

        $storedInvoice = app(StorageInvoiceAction::class)->handle($signedInvoice);

        $qrLink = $this->getQrlInk($storedInvoice->invoiceXmlPath, $env);

        return new InvoiceData($signedInvoice, $qrLink, $storedInvoice);
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
        app(ValidateCertAction::class)->handle($certPath, $certPassword);

        $signedInvoice = app(SignInvoiceAction::class)->handle($data, $certPath, $certPassword);

        $storedInvoice = app(StorageInvoiceAction::class)->handle($signedInvoice);

        $qrLink = $this->getQrlInk($storedInvoice->invoiceXmlPath, $env);

        return new InvoiceData($signedInvoice, $qrLink, $storedInvoice);
    }

    /**
     * Re-submit an existing stored XML file to DGII.
     *
     * @param  string  $xmlPath  The relative path of the stored XML.
     * @param  string|null  $env  The environment to use.
     * @param  string|null  $certPath  Optional certificate path.
     * @param  string|null  $certPassword  Optional certificate password.
     * @return InvoiceReceived The transaction result with the new DGII response.
     *
     * @throws Exception
     */
    public function submit(string $xmlPath, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceReceived
    {
        app(ValidateCertAction::class)->handle($certPath, $certPassword);

        return app(SendInvoiceAction::class)->handle($xmlPath, $env, $certPath, $certPassword);
    }

    /**
     * Store and send an electronic invoice to DGII, generating the acknowledgment.
     *
     * @param  string  $xmlContent  Signed main XML content.
     * @param  string  $token  Valid authentication token.
     * @param  string|null  $env  The environment to use.
     * @param  string|null  $certPath  Optional certificate path.
     * @param  string|null  $certPassword  Optional certificate password.
     * @return InvoiceData Complete transaction data including acknowledgment.
     *
     * @throws Exception
     */
    public function send(string $xmlContent, string $token, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        app(ValidateCertAction::class)->handle($certPath, $certPassword);

        $invoiceXml = new InvoiceXml($xmlContent);

        $signedInvoice = new SignedInvoice($invoiceXml);

        $storedInvoice = app(StorageInvoiceAction::class)->handle($signedInvoice);

        $invoiceReceived = app(SendInvoiceAction::class)->handle(
            $storedInvoice->invoiceXmlPath,
            $env,
            $certPath,
            $certPassword,
            $token,
            $invoiceXml
        );

        $acknowledgmentXmlContent = app(GenerateAcknowledgmentAction::class)->handle($invoiceXml, $invoiceReceived);

        $signedAcknowledgmentXml = app(SignAcknowledgmentAction::class)->handle($acknowledgmentXmlContent, $certPath, $certPassword);

        $acknowledgmentXmlPath = app(StorageAcknowledgmentAction::class)->handle($signedAcknowledgmentXml);

        $qrLink = $this->getQrlInk($storedInvoice->invoiceXmlPath, $env);

        return new InvoiceData(
            $signedInvoice,
            $qrLink,
            $storedInvoice,
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
     * @return InvoiceReceived Current status of the invoice.
     *
     * @throws Exception
     */
    public function checkStatus(string $xmlPath, ?string $trackId = null, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceReceived
    {
        app(ValidateCertAction::class)->handle($certPath, $certPassword);

        return app(ValidateInvoiceAction::class)->handle($xmlPath, $trackId, $env, $certPath, $certPassword);
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
        return app(GenerateInvoicePdfAction::class)->handle($xmlContent, $qrLink, $logo);
    }
}
