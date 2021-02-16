<?php

namespace ImpressCMS\Descriptor\Module;

use Imponeer\Contracts\ExtensionInfo\ExtensionInfoInterface;
use Imponeer\Contracts\ExtensionInfo\Features\SupportReplacementsPackages;
use Imponeer\Contracts\ExtensionInfo\Features\SupportsAssetsInterface;
use Imponeer\Contracts\ExtensionInfo\Features\SupportsBlocksInterface;
use Imponeer\Contracts\ExtensionInfo\Features\SupportsCommentsInterface;
use Imponeer\Contracts\ExtensionInfo\Features\SupportsConflictedPackages;
use Imponeer\Contracts\ExtensionInfo\Features\SupportsCronJobsInterface;
use Imponeer\Contracts\ExtensionInfo\Features\SupportsHooksInterface;
use Imponeer\Contracts\ExtensionInfo\Features\SupportsIconsInterface;
use Imponeer\Contracts\ExtensionInfo\Features\SupportsNotificationsInterface;
use Imponeer\Contracts\ExtensionInfo\Features\SupportsScreenshotsInterface;
use Imponeer\Contracts\ExtensionInfo\Features\SupportsSearchInterface;
use Imponeer\Contracts\ExtensionInfo\Features\SupportsTemplatesInterface;
use Imponeer\Contracts\ExtensionInfo\Features\SupportsUserConfigItemsInterface;

/**
 * Describes module
 *
 * @package ImpressCMS\Descriptor\Module
 */
interface ModuleInfoInterface
    extends
    ExtensionInfoInterface,
    SupportsScreenshotsInterface,
    SupportsAssetsInterface,
    SupportReplacementsPackages,
    SupportsHooksInterface,
    SupportsIconsInterface,
    SupportsConflictedPackages,
    SupportsTemplatesInterface,
    SupportsCommentsInterface,
    SupportsUserConfigItemsInterface,
    SupportsNotificationsInterface,
    SupportsCronJobsInterface,
    SupportsBlocksInterface,
    SupportsSearchInterface
{

    /**
     * Is this module official? (only this for compatibility with legacy modules)
     *
     * @return bool
     */
    public function isOfficial(): bool;

    /**
     * Gets object_items key
     *
     * @return string[]
     */
    public function getObjectItems(): array;

    /**
     * Gets warning message
     *
     * @return string|null
     */
    public function getWarning(): ?string;
}