<?php

namespace PlatinumPlace\LaravelDgii\Services;

use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use PlatinumPlace\LaravelDgii\Actions\Invoice\GenerateInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\Invoice\GenerateInvoiceQrLinkAction;
use PlatinumPlace\LaravelDgii\Actions\Invoice\SendInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\Invoice\SignInvoiceAction;
use PlatinumPlace\LaravelDgii\Actions\Invoice\StorageInvoiceAction;
use PlatinumPlace\LaravelDgii\Support\StorageService;
use PlatinumPlace\LaravelDgii\Support\XmlSigner;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceGenerated;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceReceived;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceSent;
use PlatinumPlace\LaravelDgii\Data\InvoiceResponse;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\SignedInvoice;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\StoredInvoice;

class DgiiInvoiceService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected XmlSigner      $xmlSigner,
        protected StorageService $storageService,
    )
    {
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
        $signedInvoice= new SignedInvoice(
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
}
