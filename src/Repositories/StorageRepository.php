<?php

namespace PlatinumPlace\LaravelDgii\Repositories;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Repository for managing file persistence within the configured storage disk.
 */
class StorageRepository
{
    /**
     * The filesystem instance.
     */
    protected Filesystem $storage;

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->storage = Storage::disk(config('dgii.storage_disk'));
    }

    /**
     * Saves a file to the storage with an automatic date-based path.
     *
     * @return string The relative path to the saved file.
     */
    public function save(string $file, ?string $fileName = null): string
    {
        $path = sprintf(
            config('dgii.storage_path').'/%s/%s/%s/%s/%s.xml',
            now()->format('Y'),
            now()->format('m'),
            now()->format('d'),
            Str::uuid(),
            $fileName ?? Str::uuid(),
        );

        $this->storage->put($path, $file);

        return $path;
    }

    /**
     * Retrieves the content of a file from storage.
     */
    public function get(string $path): string
    {
        return $this->storage->get($path);
    }

    /**
     * Checks if a file exists in storage.
     */
    public function exists(string $path): bool
    {
        return $this->storage->exists($path);
    }

    /**
     * Throws an exception if the file does not exist.
     *
     * @throws \InvalidArgumentException
     */
    public function ifExists(string $path): void
    {
        if (! $this->exists($path)) {
            throw new \InvalidArgumentException("El archivo ubicado en la ruta [{$path}] no existe.");
        }
    }

    /**
     * Get the absolute path to a file in storage.
     */
    public function realPath(string $path): string
    {
        return $this->storage->path($path);
    }
}
