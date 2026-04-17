<?php

namespace PlatinumPlace\LaravelDgii\Actions\CancellationRange;

use PlatinumPlace\LaravelDgii\Support\StorageService;
use PlatinumPlace\LaravelDgii\ValueObjects\CancellationRange\CancellationRangeXml;
use PlatinumPlace\LaravelDgii\ValueObjects\CancellationRange\StoredCancellationRange;

/**
 * Action to persist a Cancellation Range (ANECF) XML to storage.
 */
class StorageCancellationRangeAction
{
    /**
     * Create a new class instance.
     *
     * @param StorageService $storageService Storage service instance.
     */
    public function __construct(protected StorageService $storageService)
    {
        //
    }

    /**
     * Store the signed Cancellation Range XML content.
     *
     * @param CancellationRangeXml $cancellationRangeXml The cancellation range XML object.
     * @return StoredCancellationRange The stored cancellation range data.
     */
    public function handle(CancellationRangeXml $cancellationRangeXml): StoredCancellationRange
    {
        $cancellationRangeXmlPath = $this->storageService->putXml($cancellationRangeXml->xmlContent);

        return new StoredCancellationRange($cancellationRangeXml, $cancellationRangeXmlPath);
    }
}
