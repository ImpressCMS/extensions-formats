<?php

namespace ImpressCMS\Descriptor\Theme;

/**
 * Interface that defines admin descriptor
 *
 * @package ImpressCMS\Descriptor
 */
interface ThemeInfoInterface extends \Imponeer\Contracts\ExtensionInfo\ExtensionInfoInterface, \Imponeer\Contracts\ExtensionInfo\Features\SupportsScreenshotsInterface
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