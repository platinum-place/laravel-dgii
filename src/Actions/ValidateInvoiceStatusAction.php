<?php

namespace PlatinumPlace\LaravelDgii\Actions;

use Illuminate\Http\Client\ConnectionException;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceData;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\Repositories\DgiiConsumeInvoiceRepository;
use PlatinumPlace\LaravelDgii\Repositories\DgiiInvoiceRepository;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;
use PlatinumPlace\LaravelDgii\Services\DgiiAuthenticator;
use PlatinumPlace\LaravelDgii\Services\DgiiQrResolver;
use PlatinumPlace\LaravelDgii\Services\XmlSigner;
use PlatinumPlace\LaravelDgii\Traits\InteractsWithInvoice;

/**
 * Class ValidateInvoiceStatusAction
 *
 * This action is responsible for querying the DGII to verify the current status
 * of a previously submitted invoice. It identifies whether the document
 * has been accepted, rejected, or is still being processed.
 */
class ValidateInvoiceStatusAction
{
    use InteractsWithInvoice;

    /**
     * Create a new validate invoice status action instance.
     */
    public function __construct(
        protected XmlSigner $xmlSigner,
        protected StorageRepository $storage,
        protected DgiiAuthenticator $authenticator,
        protected DgiiInvoiceRepository $invoiceRepository,
        protected DgiiConsumeInvoiceRepository $consumeRepository,
        protected DgiiQrResolver $qrResolver,
    ) {
        //
    }

    /**
     * Handle the invoice status validation.
     *
     * Execution Flow:
     * 1. Retrieve: Get the signed XML content from storage to extract document metadata.
     * 2. Authenticate: Obtain a security token from DGII.
     * 3. Query: Fetch the status from the DGII (using trackId or document metadata).
     * 4. QR Resolver: Generate the URL for the invoice's QR code.
     *
     * @throws ConnectionException
     */
    public function handle(string $path, ?string $trackId = null, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        $signed = $this->storage->get($path);

        $object = new InvoiceXml($signed);

        $token = $this->authenticateAndGetToken($env, $certPath, $certPassword);

        $response = $this->findInvoiceStatusInDgii($object, $token, $trackId, $env);

        $qrLink = $this->qrResolver->getInvoiceQrLink($object, $env);

        return new InvoiceData(xml: $object, qrLink: $qrLink, response: $response);
    }
}
