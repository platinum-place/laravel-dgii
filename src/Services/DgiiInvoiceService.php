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
use PlatinumPlace\LaravelDgii\Support\StorageService;
use PlatinumPlace\LaravelDgii\Support\XmlSigner;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceReceived;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\SignedInvoice;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\StoredInvoice;

/**
 * Service to manage e-CF (Electronic Invoice) lifecycle operations.
 */
class DgiiInvoiceService
{
    /**
     * Create a new service instance.
     *
     * @param  XmlSigner  $xmlSigner  XML signing service.
     * @param  StorageService  $storageService  Storage service.
     */
    public function __construct(
        protected XmlSigner $xmlSigner,
        protected StorageService $storageService,
    ) {
        //
    }

    /**
     * Generate the verification QR link for an e-CF.
     *
     * @param  string  $xmlContent  Signed XML content.
     * @param  string|null  $env  The environment to use.
     * @return string Full QR verification URL.
     *
     * @throws Exception
     */
    public function getQrLink(string $xmlContent, ?string $env = null): string
    {
        return app(GenerateInvoiceQrLinkAction::class)->handle($xmlContent, $env);
    }

    /**
     * Store a signed XML invoice in the file system.
     *
     * @param  string  $xmlContent  Signed XML content.
     * @param  string|null  $env  The environment to use.
     * @return StoredInvoice Stored invoice data.
     *
     * @throws Exception
     */
    public function storage(string $xmlContent, ?string $env = null): StoredInvoice
    {
        $signedInvoice = new SignedInvoice(
            new InvoiceXml($xmlContent),
            $this->getQrLink($xmlContent, $env),
        );

        return app(StorageInvoiceAction::class)->handle($signedInvoice);
    }

    /**
     * Generate, sign, and store an invoice from raw data.
     *
     * @param  array  $data  Template data for the invoice.
     * @param  string|null  $env  The environment to use.
     * @param  string|null  $certPath  Optional certificate path.
     * @param  string|null  $certPassword  Optional certificate password.
     * @return StoredInvoice Stored and signed invoice data.
     *
     * @throws Exception
     */
    public function sign(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): StoredInvoice
    {
        $invoiceXmlContent = app(GenerateInvoiceAction::class)->handle($data);

        $signedInvoice = app(SignInvoiceAction::class)->handle($invoiceXmlContent, $env, $certPath, $certPassword);

        return app(StorageInvoiceAction::class)->handle($signedInvoice);
    }

    /**
     * Submit a stored invoice to DGII and generate the acknowledgment.
     *
     * @param  StoredInvoice  $storedInvoice  The stored invoice object.
     * @param  string|null  $env  The environment to use.
     * @param  string|null  $certPath  Optional certificate path.
     * @param  string|null  $certPassword  Optional certificate password.
     * @param  string|null  $token  Optional existing authentication token.
     * @return InvoiceData Complete transaction data including response and acknowledgment.
     *
     * @throws Exception
     */
    public function submit(StoredInvoice $storedInvoice, ?string $env = null, ?string $certPath = null, ?string $certPassword = null, ?string $token = null): InvoiceData
    {
        $invoiceReceived = app(SendInvoiceAction::class)->handle($storedInvoice, $env, $certPath, $certPassword, $token);

        $acknowledgmentXmlContent = app(GenerateAcknowledgmentAction::class)->handle($storedInvoice->signedInvoice->invoiceXml, $invoiceReceived);

        $signedAcknowledgmentXml = app(SignAcknowledgmentAction::class)->handle($acknowledgmentXmlContent, $certPath, $certPassword);

        $storedAcknowledgment = app(StorageAcknowledgmentAction::class)->handle($signedAcknowledgmentXml);

        return new InvoiceData($storedInvoice, $invoiceReceived, $storedAcknowledgment);
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
            $storedInvoice = $this->sign($xmlContent, $env, $certPath, $certPassword);
        } else {
            $signedInvoice = new SignedInvoice(
                new InvoiceXml($xmlContent),
                $this->getQrLink($xmlContent, $env),
            );

            $storedInvoice = app(StorageInvoiceAction::class)->handle($signedInvoice);
        }

        return $this->submit($storedInvoice, $env, $certPath, $certPassword, $token);
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
        return app(CheckInvoiceStatusAction::class)->handle($xmlPath, $trackId, $env, $certPath, $certPassword);
    }

    public function generatePdf(string $xmlContent, string $qrLink, ?string $logo = null): string
    {
        return app(GenerateInvoicePdfAction::class)->handle($xmlContent, $qrLink, $logo);
    }
}
