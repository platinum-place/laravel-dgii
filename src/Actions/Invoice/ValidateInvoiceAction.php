<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoice;

use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceReceived;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;

/**
 * Orchestrates the validation and status checking process by delegating to specialized actions.
 */
class ValidateInvoiceAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected StorageRepository $storageRepository,
        protected ValidateConsumeInvoiceAction $validateConsumeInvoiceAction,
        protected ValidateStandardInvoiceAction $validateStandardInvoiceAction,
    ) {
        //
    }

    /**
     * Orchestrate the validation process by dispatching to the appropriate specialized action.
     *
     * @param  string  $xmlPath  Relative path of the stored XML file.
     * @param  string|null  $trackId  Tracking ID from a previous submission.
     * @param  string|null  $env  The environment to use.
     * @param  string|null  $certPath  Optional certificate path.
     * @param  string|null  $certPassword  Optional certificate password.
     * @param  string|null  $token  Optional pre-obtained token.
     * @param  InvoiceXml|null  $invoiceXml  Optional pre-loaded InvoiceXml object.
     * @return InvoiceReceived The response object from DGII.
     */
    public function handle(string $xmlPath, ?string $trackId = null, ?string $env = null, ?string $certPath = null, ?string $certPassword = null, ?InvoiceXml $invoiceXml = null, ?string $token = null): InvoiceReceived
    {
        if (! $invoiceXml) {
            $xmlContent = $this->storageRepository->get($xmlPath);
            $invoiceXml = new InvoiceXml($xmlContent);
        }

        return $invoiceXml->isConsumeInvoice()
            ? $this->validateConsumeInvoiceAction->handle(
                $invoiceXml->getSenderIdentification(),
                $invoiceXml->getSequenceNumber(),
                $invoiceXml->getSecurityCode(),
                $env,
                $certPath,
                $certPassword
            )
            : $this->validateStandardInvoiceAction->handle(
                $trackId,
                $env,
                $certPath,
                $certPassword,
                $token,
            );
    }
}
