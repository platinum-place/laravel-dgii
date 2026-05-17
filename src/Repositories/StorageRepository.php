<?php

namespace PlatinumPlace\LaravelDgii\Repositories;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StorageRepository
{
    protected Filesystem $storage;

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->storage = Storage::disk(config('dgii.storage_disk'));
    }

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

    public function get(string $path): string
    {
        return $this->storage->get($path);
    }

    public function exists(string $path): bool
    {
        return $this->storage->exists($path);
    }

    public function ifExists(string $path): void
    {
        if (! $this->exists($path)) {
            throw new \InvalidArgumentException("El archivo ubicado en la ruta [{$path}] no existe.");
        }
    }

    public function realPath(string $path): string
    {
        return $this->storage->path($path);
    }
}
