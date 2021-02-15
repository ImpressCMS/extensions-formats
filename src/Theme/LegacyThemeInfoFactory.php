<?php

namespace ImpressCMS\Descriptor\Theme;

use Imponeer\Contracts\ExtensionInfo\Exceptions\UnsupportedExtensionException;
use Imponeer\Contracts\ExtensionInfo\ExtensionInfoFactoryInterface;
use Imponeer\Contracts\ExtensionInfo\ExtensionInfoInterface;
use Imponeer\Contracts\ExtensionInfo\Factory\FromPathFactoryInterface;

/**
 * Factory to make legacy theme info readers
 *
 * @package ImpressCMS\Descriptor\Theme
 */
class LegacyThemeInfoFactory implements ExtensionInfoFactoryInterface, FromPathFactoryInterface
{
    /**
     * @var string
     */
    private $modulesPath;

    /**
     * LegacyThemeInfoFactory constructor.
     *
     * @param string $modulesPath
     */
    public function __construct(string $modulesPath)
    {
        $this->modulesPath = $modulesPath;
    }

    /**
     * @inheritDoc
     */
    public function createFromPath(string $path): ExtensionInfoInterface
    {
        if (!$this->supportsPath($path)) {
            throw new UnsupportedExtensionException(
                basename($path)
            );
        }

        return new LegacyThemeInfo($path, $this->modulesPath);
    }

    /**
     * @inheritDoc
     */
    public function supportsPath(string $path): bool
    {
        return file_exists($path) && is_dir($path) && (
                file_exists($path . DIRECTORY_SEPARATOR . 'theme.html') ||
                file_exists($path . DIRECTORY_SEPARATOR . 'theme_admin.html')
            );
    }
}