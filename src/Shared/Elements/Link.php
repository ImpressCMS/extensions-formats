<?php

namespace ImpressCMS\Descriptor\Shared\Elements;

use Imponeer\Contracts\ExtensionInfo\Enum\LinkType;

/**
 * Link object
 *
 * @package ImpressCMS\Descriptor\Shared\Elements
 */
class Link implements \Imponeer\Contracts\ExtensionInfo\Elements\LinkInterface
{
    /**
     * @var string
     */
    private $url;
    /**
     * @var LinkType
     */
    private $type;

    /**
     * Link constructor.
     *
     * @param string $url
     * @param LinkType $type
     */
    public function __construct(LinkType $type, string $url)
    {
        $this->url = $url;
        $this->type = $type;
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
    public function getType(): LinkType
    {
        return $this->type;
    }
}