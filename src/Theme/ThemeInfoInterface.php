<?php

namespace ImpressCMS\Descriptor\Theme;

use Imponeer\Contracts\ExtensionInfo\ExtensionInfoInterface;
use Imponeer\Contracts\ExtensionInfo\Features\SupportsAssetsInterface;
use Imponeer\Contracts\ExtensionInfo\Features\SupportsScreenshotsInterface;

/**
 * Interface that defines admin descriptor
 *
 * @package ImpressCMS\Descriptor
 */
interface ThemeInfoInterface extends ExtensionInfoInterface, SupportsScreenshotsInterface, SupportsAssetsInterface
{

    /**
     * Returns true if theme has admin side
     *
     * @return bool
     */
    public function hasAdmin(): bool;

    /**
     * Returns true if theme has user side
     *
     * @return bool
     */
    public function hasUser(): bool;

}