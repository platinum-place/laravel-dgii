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
 * Class SendInvoiceAction
 *
 * This action handles the re-submission of a previously signed and stored invoice
 * to the DGII. It is useful for retrying failed submissions or sending
 * documents that were signed offline.
 */
class SendInvoiceAction
{
    use InteractsWithInvoice;

    /**
     * Create a new send invoice action instance.
     */
    public function __construct(
        protected XmlSigner $xmlSigner,
        protected StorageRepository $storage,
        protected DgiiAuthenticator $authenticator,
        protected DgiiInvoiceRepository $invoiceRepository,
        protected DgiiConsumeInvoiceRepository $consumeRepository,
        protected DgiiQrResolver $qrResolver,
        protected ProcessAcknowledgmentAction $processAcknowledgment,
    ) {
        //
    }

    /**
     * Handle the invoice re-submission process.
     *
     * Execution Flow:
     * 1. Retrieve: Fetch the signed XML content from storage using the provided path.
     * 2. Authenticate: Obtain a valid authentication token from the DGII.
     * 3. Submit: Send the signed invoice XML to the appropriate DGII endpoint.
     * 4. QR Resolver: Generate the URL for the invoice's QR code.
     * 5. Acknowledgment: Process and store the receipt acknowledgment from the DGII.
     *
     * @throws ConnectionException
     */
    public function handle(string $path, ?string $env = null, ?string $certPath = null, ?string $certPassword = null): InvoiceData
    {
        $signed = $this->storage->get($path);

        $object = new InvoiceXml($signed);

        $filePath = $this->storage->realPath($path);

        $token = $this->authenticateAndGetToken($env, $certPath, $certPassword);

        $response = $this->sendInvoice($object, $filePath, $token, $env);

        $qrLink = $this->qrResolver->getInvoiceQrLink($object, $env);

        $acknowledgmentObject = $this->processAcknowledgment->handle($object, $response, $certPath, $certPassword);

        return new InvoiceData(
            xml: $object,
            path: $path,
            qrLink: $qrLink,
            response: $response,
            acknowledgment: $acknowledgmentObject,
        );
    }
}
