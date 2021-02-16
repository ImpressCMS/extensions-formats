<?php

namespace ImpressCMS\Descriptor\Shared\Elements;

use Imponeer\Contracts\ExtensionInfo\Elements\TemplateInterface;
use League\Flysystem\FileAttributes;

/**
 * Template item
 *
 * @package ImpressCMS\Descriptor\Shared\Elements
 */
class Template implements TemplateInterface
{
    /**
     * @var string
     */
    private $path;
    /**
     * @var string
     */
    private $description;

    /**
     * Icon constructor.
     *
     * @param string $path
     * @param string $description
     */
    public function __construct(string $path, string $description = '')
    {
        $this->path = $path;
        $this->description = $description;
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
    public function getDescription(): string
    {
        return $this->description;
    }
}