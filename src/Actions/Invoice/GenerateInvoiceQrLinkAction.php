<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoice;

use PlatinumPlace\LaravelDgii\Clients\ConsumeInvoiceClient;
use PlatinumPlace\LaravelDgii\Clients\InvoiceClient;
use PlatinumPlace\LaravelDgii\Support\StorageService;
use PlatinumPlace\LaravelDgii\ValueObjects\Invoice\InvoiceXml;

/**
 * Action to generate the full public verification URL (QR link) for an e-CF.
 */
class GenerateInvoiceQrLinkAction
{
    /**
     * Create a new class instance.
     *
     * @param StorageService $storageService Storage service instance.
     * @param InvoiceClient $invoiceClient Standard e-CF client.
     * @param ConsumeInvoiceClient $consumeInvoiceClient Consumption invoice client.
     */
    public function __construct(
        protected StorageService $storageService,
        protected InvoiceClient $invoiceClient,
        protected ConsumeInvoiceClient $consumeInvoiceClient,
    ) {
        //
    }

    /**
     * Generate the full fiscal stamp URL for public inquiry.
     *
     * This URL should be embedded in the QR code on the PDF.
     *
     * @param string|InvoiceXml $invoiceXml Relative path of the signed XML file or the value object itself.
     * @param string|null $env The environment to use.
     * @return string Full verification URL.
     */
    public function handle(string|InvoiceXml $invoiceXml, ?string $env = null): string
    {
        if (is_string($invoiceXml)) {
            $invoiceXml = new InvoiceXml(
                $this->storageService->get($invoiceXml)
            );
        }

        return $invoiceXml->isConsumeInvoice()
            ? $this->consumeInvoiceClient->fetchQRLink($invoiceXml, $env)
            : $this->invoiceClient->fetchQRLink($invoiceXml, $env);
    }
}
