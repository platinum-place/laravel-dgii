<?php

namespace PlatinumPlace\LaravelDgii\Services;

use Exception;
use PlatinumPlace\LaravelDgii\Actions\Acknowledgment\GenerateAcknowledgmentAction;
use PlatinumPlace\LaravelDgii\Actions\Acknowledgment\SignAcknowledgmentAction;
use PlatinumPlace\LaravelDgii\Actions\Acknowledgment\StorageAcknowledgmentAction;
use PlatinumPlace\LaravelDgii\Actions\Invoice\CheckInvoiceStatusAction;
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
     * Generate the verification QR link for an e-CF.
     *
     * @param  string  $xmlPath  Relative path of the signed XML file.
     * @param  string|null  $env  The environment to use.
     * @return string Full QR verification URL.
     *
     * @throws Exception
     */
    public function getQrlInk(string $xmlPath, ?string $env = null): string
    {
        return app(GenerateInvoiceQrLinkAction::class)->handle($xmlPath, $env);
    }

    /**
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
     * Store a signed XML invoice in the file system.
     *
     * @param  string  $xmlContent  Signed XML content.
     * @param  string|null  $env  The environment to use.
     * @return InvoiceData Invoice data with stored invoice information.
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
        [$invoiceXml, $integralInvoiceXml] = app(GenerateInvoiceAction::class)->handle($data);

        [$invoiceXml, $integralInvoiceXml] = app(SignInvoiceAction::class)->handle($invoiceXml, $env, $certPath, $certPassword, $integralInvoiceXml);

        return $this->returnStoredInvoiceData($invoiceXml, $env, $integralInvoiceXml);
    }

    /**
     * Internal method to send the invoice and generate the acknowledgment.
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

    public function generatePdf(string $xmlContent, string $qrLink, ?string $logo = null): string
    {
        return app(GenerateInvoicePdfAction::class)->handle($xmlContent, $qrLink, $logo);
    }

    /**
     * @throws Exception
     */
    public function submit(string $xmlPath, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        $invoiceData = new InvoiceData(
            InvoiceXml::fromXmlPath($xmlPath),
        );

        $invoiceReceived = app(SendInvoiceAction::class)->handle($invoiceData, $env, $certPath, $certPassword);

        return new InvoiceData(
            InvoiceXml::fromXmlPath($xmlPath),
            invoiceReceived: $invoiceReceived,
        );
    }
}
