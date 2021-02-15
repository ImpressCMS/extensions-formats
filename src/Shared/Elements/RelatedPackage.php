<?php

namespace ImpressCMS\Descriptor\Shared\Elements;

use Imponeer\Contracts\ExtensionInfo\Elements\RelatedPackageInterface;

/**
 * RelatedPackage instance
 *
 * @package ImpressCMS\Descriptor\Shared\Elements
 */
class RelatedPackage implements RelatedPackageInterface
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $version;
    /**
     * @var string
     */
    private $reason;

    public function __construct(string $name, string $version, string $reason = '')
    {
        $this->name = $name;
        $this->version = $version;
        $this->reason = $reason;
    }

    /**
     * @inheritDoc
     */
    public function getPackageName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function getVersionConstraint(): string
    {
        return $this->version;
    }

    /**
     * @inheritDoc
     */
    public function getReason(): string
    {
        return $this->reason;
    }
}