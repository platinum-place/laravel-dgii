<?php

namespace PlatinumPlace\LaravelDgii\Support;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StorageService
{
    protected Filesystem $storage;

    /**
     * Crea una nueva instancia para el servicio de almacenamiento.
     */
    public function __construct()
    {
        $this->storage = Storage::disk(config('dgii.storage_disk'));
    }

    /**
     * Guardar el contenido de un XML en el disco configurado.
     * Genera una estructura de carpetas por año/mes/día/uuid de forma automática.
     *
     * @param  string  $xml  Contenido XML a persistir.
     * @param  string|null  $xmlName  Nombre base sugerido para el archivo (opcional).
     * @return string Ruta relativa del archivo guardado.
     */
    public function putXml(string $xml, ?string $xmlName = null): string
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
     * Obtener el contenido de un archivo desde el storage.
     */
    public function get(string $xmlPath): string
    {
        return $this->storage->get($xmlPath);
    }

    /**
     * Obtener la ruta absoluta de un archivo (útil para adjuntar archivos en HTTP).
     */
    public function path(string $xmlPath): string
    {
        return $this->storage->path($xmlPath);
    }
}
