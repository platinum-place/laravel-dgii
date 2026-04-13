<?php

namespace PlatinumPlace\LaravelDgii\Helpers;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

class StorageHelper
{
    protected Filesystem $storage;

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->storage = Storage::disk(config('dgii.storage_disk'));
    }

    public function putXml(string $xml, ?string $xmlName = null): string
    {
        $xmlPath = sprintf(
            config('dgii.storage_path') . '/%s/%s/%s/%s/%s.xml',
            now()->format('Y'),
            now()->format('m'),
            now()->format('d'),
            \Str::uuid(),
            $xmlName ?? \Str::uuid(),
        );

        $this->storage->put($xmlPath, $xml);

        return $xmlPath;
    }

    public function get(string $xmlPath): string
    {
        return $this->storage->get($xmlPath);
    }

    public function path(string $xmlPath): string
    {
        return $this->storage->path($xmlPath);
    }
}