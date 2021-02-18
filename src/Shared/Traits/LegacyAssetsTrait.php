<?php

namespace ImpressCMS\Descriptor\Shared\Traits;

use League\Flysystem\FileAttributes;
use League\Flysystem\Filesystem;
use League\Flysystem\StorageAttributes;

/**
 * Gets collection of legacy assets
 *
 * @package ImpressCMS\Descriptor\Shared\Traits
 */
trait LegacyAssetsTrait
{
    /**
     * Defines list of mimetypes that are used like legacy assets
     *
     * @var string[]
     */
    protected static $legacyAssetsMimetypes = [
        'application/json', // .json
        'application/ld+json', // .jsonld
        'application/vnd.ms-fontobject', // .eot
        'audio/aac', // .aac
        'audio/aacp', // .aac
        'audio/flac', // .flac
        'audio/mp4', // .mp4
        'audio/mpeg', // .mp3
        'audio/ogg', // .ogg
        'audio/wav', // .wav
        'audio/webm', // .webm
        'audio/x-caf', // .caf
        'font/otf', // .otf
        'font/ttf', // .ttf
        'font/woff', // .woff
        'font/woff2', // .woff2
        'image/gif', // .gif
        'image/jpeg', // .jpg
        'image/png', // .png
        'image/svg+xml', // .svg
        'image/vnd.microsoft.icon', // .ico
        'image/webp', // .webp
        'text/css', // .css
        'text/javascript', // .js
        'text/xml', // .xml
        'video/mp4', // .mp4
        'video/ogg', // .ogg
        'video/webm', // .webm
    ];

    /**
     * @inheritDoc
     */
    public function getAssets(): iterable
    {
        return $this
            ->getFiles()
            ->listContents('/', Filesystem::LIST_DEEP)
            ->filter(function (StorageAttributes $attributes) {
                return $attributes->isFile() && ($attributes instanceof FileAttributes) && in_array(
                        $attributes->mimeType(),
                        static::$legacyAssetsMimetypes,
                        true
                    );
            });
    }

}