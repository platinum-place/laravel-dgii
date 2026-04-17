<?php

namespace PlatinumPlace\LaravelDgii\Services;

use Exception;
use PlatinumPlace\LaravelDgii\Actions\Acknowledgment\GenerateAcknowledgmentAction;
use PlatinumPlace\LaravelDgii\Actions\Acknowledgment\StorageAcknowledgmentAction;
use PlatinumPlace\LaravelDgii\Actions\Invoice\GenerateInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\Invoice\GenerateInvoiceQrLinkAction;
use PlatinumPlace\LaravelDgii\Actions\Invoice\SendInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\Invoice\SignInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\Invoice\StorageInvoiceAction;
use PlatinumPlace\LaravelDgii\Support\StorageService;
use PlatinumPlace\LaravelDgii\Support\XmlSigner;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceGenerated;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\SignedInvoice;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\StoredInvoice;

class DgiiInvoiceService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected XmlSigner $xmlSigner,
        protected StorageService $storageService,
    ) {
        //
    }

    /**
     * @throws Exception
     */
    public function getQrlInk(string $xmlContent, ?string $env = null): string
    {
        return app(GenerateInvoiceQrLinkAction::class)->handle($xmlContent, $env);
    }

    /**
     * @throws Exception
     */
    public function storage(InvoiceGenerated $invoiceGenerated, ?string $env = null): StoredInvoice
    {
        $signedInvoice = new SignedInvoice(
            $invoiceGenerated->invoiceXml,
            $this->getQrlInk($invoiceGenerated->invoiceXml->xmlContent, $env),
            $invoiceGenerated->integralInvoiceXml,
        );

        return app(StorageInvoiceAction::class)->handle($signedInvoice);
    }

    /**
     * @throws Exception
     */
    public function sign(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): StoredInvoice
    {
        $invoiceGenerated = app(GenerateInvoiceAction::class)->handle($data);

        $signedInvoice = app(SignInvoiceAction::class)->handle($invoiceGenerated, $env, $certPath, $certPassword);

        return app(StorageInvoiceAction::class)->handle($signedInvoice);
    }

    public function send(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null)
    {
        $storedInvoice = $this->sign($data, $env, $certPath, $certPassword);

        $invoiceReceived = app(SendInvoiceAction::class)->handle($storedInvoice, $env, $certPath, $certPassword);

        $acknowledgmentGenerated = app(GenerateAcknowledgmentAction::class)->handle($storedInvoice->signedInvoice->invoiceXml, $invoiceReceived);

        $signedAcknowledgment = $this->xmlSigner->sign($acknowledgmentGenerated, $certPath, $certPassword);

        $storedAcknowledgment = app(StorageAcknowledgmentAction::class)->handle($signedAcknowledgment);
    }
}
