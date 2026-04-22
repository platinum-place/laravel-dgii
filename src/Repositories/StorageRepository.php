<?php

namespace PlatinumPlace\LaravelDgii\Repositories;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Service to handle XML file storage in the configured disk.
 */
class StorageRepository
{
    /** @var Filesystem The filesystem disk instance. */
    protected Filesystem $storage;

    /**
     * Create a new storage service instance.
     */
    public function __construct()
    {
        $this->storage = Storage::disk(config('dgii.storage_disk'));
    }

    /**
     * Save XML content to the configured disk.
     * Generates a folder structure by year/month/day/uuid automatically.
     *
     * @param  string  $xml  XML content to persist.
     * @param  string|null  $xmlName  Optional suggested base name for the file.
     * @return string Relative path of the saved file.
     */
    public function save(string $xml, ?string $xmlName = null): string
    {
        $xmlPath = sprintf(
            config('dgii.storage_path').'/%s/%s/%s/%s/%s.xml',
            now()->format('Y'),
            now()->format('m'),
            now()->format('d'),
            Str::uuid(),
            $xmlName ?? Str::uuid(),
        );

        $this->storage->put($xmlPath, $xml);

        return $xmlPath;
    }

    /**
     * Get the content of a file from storage.
     *
     * @param  string  $xmlPath  The relative path of the XML file.
     * @return string The raw XML content.
     */
    public function get(string $xmlPath): string
    {
        return $this->storage->get($xmlPath);
    }

    /**
     * Get the absolute path of a file.
     * Useful for attaching files in HTTP requests or local processing.
     *
     * @param  string  $xmlPath  The relative path of the XML file.
     * @return string The absolute path in the server.
     */
    public function realPath(string $xmlPath): string
    {
        return $this->storage->path($xmlPath);
    }
}
