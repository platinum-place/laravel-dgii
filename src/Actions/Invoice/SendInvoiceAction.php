<?php

namespace PlatinumPlace\LaravelDgii\Actions\Invoice;

use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceReceived;
use PlatinumPlace\LaravelDgii\Data\Invoice\InvoiceXml;
use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;

/**
 * Action to persist signed Invoice XML(s) to storage.
 */
class SendInvoiceAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected StorageRepository $storageRepository,
        protected SendConsumeInvoiceAction $sendConsumeInvoiceAction,
        protected SendStandardInvoiceAction $sendStandardInvoiceAction,
    ) {
        //
    }

    /**
     * Orchestrate the sending process by dispatching to the appropriate specialized action.
     *
     * @param  string  $xmlPath  Relative path of the stored XML file.
     * @param  string|null  $env  The environment to use.
     * @param  string|null  $certPath  Optional certificate path.
     * @param  string|null  $certPassword  Optional certificate password.
     * @param  string|null  $token  Optional pre-obtained token.
     * @param  InvoiceXml|null  $invoiceXml  Optional pre-loaded InvoiceXml object.
     * @return InvoiceReceived The response object from DGII.
     */
    public function handle(string $xmlPath, ?string $env = null, ?string $certPath = null, ?string $certPassword = null, ?string $token = null, ?InvoiceXml $invoiceXml = null): InvoiceReceived
    {
        if (! $invoiceXml) {
            $xmlContent = $this->storageRepository->get($xmlPath);
            $invoiceXml = new InvoiceXml($xmlContent);
        }

        $filePath = $this->storageRepository->realPath($xmlPath);

        return $invoiceXml->isConsumeInvoice()
            ? $this->sendConsumeInvoiceAction->handle($filePath, $env, $certPath, $certPassword)
            : $this->sendStandardInvoiceAction->handle($filePath, $env, $certPath, $certPassword, $token);
    }
}
