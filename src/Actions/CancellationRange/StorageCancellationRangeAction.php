<?php

namespace PlatinumPlace\LaravelDgii\Actions\CancellationRange;

use PlatinumPlace\LaravelDgii\Data\CancellationRangeData;
use PlatinumPlace\LaravelDgii\Support\StorageService;
use PlatinumPlace\LaravelDgii\ValueObjects\CancellationRange\CancellationRangeXml;

/**
 * Action to persist a Cancellation Range (ANECF) XML to storage.
 */
class StorageCancellationRangeAction
{
    /**
     * Create a new class instance.
     *
     * @param  StorageService  $storageService  Storage service instance.
     */
    public function __construct(protected StorageService $storageService)
    {
        //
    }

    /**
     * Store the signed Cancellation Range XML content.
     *
     * @param string $cancellationRangeXml The signed XML content to store.
     * @return string The relative path of the stored XML file.
     */
    public function handle(string $cancellationRangeXml): string
    {
        return $this->storageService->putXml($cancellationRangeXml);
    }
}
