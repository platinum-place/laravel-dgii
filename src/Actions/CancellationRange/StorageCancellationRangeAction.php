<?php

namespace PlatinumPlace\LaravelDgii\Actions\CancellationRange;

use PlatinumPlace\LaravelDgii\Support\StorageService;
use PlatinumPlace\LaravelDgii\ValueObjects\CancellationRange\CancellationRangeXml;
use PlatinumPlace\LaravelDgii\ValueObjects\CancellationRange\StoredCancellationRange;

class StorageCancellationRangeAction
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected StorageService $storageService)
    {
        //
    }

    public function handle(CancellationRangeXml $cancellationRangeXml): StoredCancellationRange
    {
        $cancellationRangeXmlPath = $this->storageService->putXml($cancellationRangeXml->xmlContent);

        return new StoredCancellationRange($cancellationRangeXml, $cancellationRangeXmlPath);
    }
}
