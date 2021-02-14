<?php

namespace ImpressCMS\Descriptor\Shared\Elements;

use Imponeer\Contracts\ExtensionInfo\Enum\ScreenshotType;

/**
 * Defines screenshot
 *
 * @package ImpressCMS\Descriptor\Shared\Elements
 */
class Screenshot implements \Imponeer\Contracts\ExtensionInfo\Elements\ScreenshotInterface
{

    /**
     * @var ScreenshotType
     */
    private $type;
    /**
     * @var string
     */
    private $url;

    /**
     * Screenshot constructor.
     *
     * @param ScreenshotType $type
     * @param string $url
     */
    public function __construct(ScreenshotType $type, string $url)
    {
        $this->type = $type;
        $this->url = $url;
    }

    /**
     * @inheritDoc
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @inheritDoc
     */
    public function getType(): ScreenshotType
    {
        return $this->type;
    }
}