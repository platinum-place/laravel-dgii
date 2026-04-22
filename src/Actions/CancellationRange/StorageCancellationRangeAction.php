<?php

namespace PlatinumPlace\LaravelDgii\Actions\CancellationRange;

use PlatinumPlace\LaravelDgii\Repositories\StorageRepository;

/**
 * Action to persist a Cancellation Range (ANECF) XML to storage.
 */
class StorageCancellationRangeAction
{
    /**
     * Create a new class instance.
     *
     * @param  StorageRepository  $storageService  Storage service instance.
     */
    public function __construct(protected StorageRepository $storageService)
    {
        //
    }

    /**
     * Store the signed Cancellation Range XML content.
     *
     * @param  string  $cancellationRangeXml  The signed XML content to store.
     * @return string The relative path of the stored XML file.
     */
    public function handle(string $cancellationRangeXml): string
    {
        return $this->storageService->save($cancellationRangeXml);
    }
}
