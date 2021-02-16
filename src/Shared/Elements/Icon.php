<?php

namespace ImpressCMS\Descriptor\Shared\Elements;

use Imponeer\Contracts\ExtensionInfo\Elements\IconInterface;
use League\Flysystem\FileAttributes;

/**
 * Defines icon
 *
 * @package ImpressCMS\Descriptor\Shared\Elements
 */
class Icon implements IconInterface
{
    /**
     * @var string
     */
    private $path;
    /**
     * @var string
     */
    private $category;

    /**
     * Icon constructor.
     *
     * @param string $path
     * @param string $category
     */
    public function __construct(string $path, string $category)
    {
        $this->path = $path;
        $this->category = $category;
    }

    /**
     * @inheritDoc
     */
    public function getFile(): FileAttributes
    {
        return new FileAttributes($this->path);
    }

    /**
     * @inheritDoc
     */
    public function getCategory(): string
    {
        return $this->category;
    }
}