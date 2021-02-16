<?php

namespace ImpressCMS\Descriptor\Shared\Elements;

use Imponeer\Contracts\ExtensionInfo\Elements\CommentPlaceInterface;
use Imponeer\Contracts\ExtensionInfo\Elements\InlineLinkInterface;

/**
 * Describes a places where can have comments
 *
 * @package ImpressCMS\Descriptor\Shared\Elements
 */
class CommentsPlace implements CommentPlaceInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var Hook[]
     */
    private $hooks;
    /**
     * @var InlineLinkInterface
     */
    private $link;

    /**
     * CommentsPlace constructor.
     *
     * @param string $placeName
     * @param InlineLinkInterface $link
     * @param Hook[] $hooks
     */
    public function __construct(
        string $placeName,
        InlineLinkInterface $link,
        array $hooks
    )
    {
        $this->name = $placeName;
        $this->hooks = $hooks;
        $this->link = $link;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function getLink(): InlineLinkInterface
    {
        return $this->link;
    }

    /**
     * @inheritDoc
     */
    public function getHooks(): iterable
    {
        return $this->hooks;
    }
}