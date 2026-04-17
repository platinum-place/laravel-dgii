<?php

namespace PlatinumPlace\LaravelDgii\Services;

use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use PlatinumPlace\LaravelDgii\Actions\Acknowledgment\GenerateAcknowledgmentAction;
use PlatinumPlace\LaravelDgii\Actions\Acknowledgment\SignAcknowledgmentAction;
use PlatinumPlace\LaravelDgii\Actions\Acknowledgment\StorageAcknowledgmentAction;
use PlatinumPlace\LaravelDgii\Actions\Invoice\CheckInvoiceStatusAction;
use PlatinumPlace\LaravelDgii\Actions\Invoice\GenerateInvoiceAction;
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
    public function storage(string $xmlContent, ?string $env = null): StoredInvoice
    {
        $signedInvoice = new SignedInvoice(
            new InvoiceXml($xmlContent),
            $this->getQrlInk($xmlContent, $env),
        );

        return app(StorageInvoiceAction::class)->handle($signedInvoice);
    }

    /**
     * @throws Exception
     */
    public function sign(array $data, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): StoredInvoice
    {
        $invoiceXmlContent = app(GenerateInvoiceAction::class)->handle($data);

        $signedInvoice = app(SignInvoiceAction::class)->handle($invoiceXmlContent, $env, $certPath, $certPassword);

        return app(StorageInvoiceAction::class)->handle($signedInvoice);
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     * @throws Exception
     */
    private function returnInvoiceData(StoredInvoice $storedInvoice, ?string $env = null, ?string $certPath = null, ?string $certPassword = null, ?string $token = null): InvoiceData
    {
        $invoiceReceived = app(SendInvoiceAction::class)->handle($storedInvoice, $env, $certPath, $certPassword, $token);

        $acknowledgmentXmlContent = app(GenerateAcknowledgmentAction::class)->handle($storedInvoice->signedInvoice->invoiceXml, $invoiceReceived);

        $signedAcknowledgmentXml = app(SignAcknowledgmentAction::class)->handle($acknowledgmentXmlContent);

        $storedAcknowledgment = app(StorageAcknowledgmentAction::class)->handle($signedAcknowledgmentXml);

        return new InvoiceData($storedInvoice, $invoiceReceived, $storedAcknowledgment);
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     * @throws Exception
     */
    public function send(string|array $xmlContent, ?string $env = null, ?string $certPath = null, ?string $certPassword = null, ?string $token = null): InvoiceData
    {
        if (is_array($xmlContent)) {
            $storedInvoice = $this->sign($xmlContent, $env, $certPath, $certPassword);
        } else {
            $signedInvoice = new SignedInvoice(
                new InvoiceXml($xmlContent),
                $this->getQrlInk($xmlContent, $env),
            );

            $storedInvoice = app(StorageInvoiceAction::class)->handle($signedInvoice);
        }

        return $this->returnInvoiceData($storedInvoice, $env, $certPath, $certPassword, $token);
    }

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function checkStatus(string $xmlPath, ?string $trackId = null, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceReceived
    {
        return app(CheckInvoiceStatusAction::class)->handle($xmlPath, $trackId, $env, $certPath, $certPassword);
    }
}
