<?php

namespace ImpressCMS\Descriptor\Theme\Composer;

use Composer\Package\Package;
use Imponeer\Contracts\ExtensionInfo\Exceptions\UnsupportedExtensionException;
use Imponeer\Contracts\ExtensionInfo\ExtensionInfoFactoryInterface;
use Imponeer\Contracts\ExtensionInfo\ExtensionInfoInterface;
use Imponeer\Contracts\ExtensionInfo\Factory\FromComposerPackageFactoryInterface;
use Imponeer\Contracts\ExtensionInfo\Factory\FromPathFactoryInterface;
use ImpressCMS\Descriptor\Shared\Traits\ComposerFactoryTrait;

/**
 * Creates Composer Theme Info readers
 *
 * @package ImpressCMS\Descriptor\Theme\Composer
 */
class ComposerThemeInfoFactory implements FromPathFactoryInterface, ExtensionInfoFactoryInterface, FromComposerPackageFactoryInterface
{
    use ComposerFactoryTrait;

    /**
     * @inheritDoc
     */
    public function createFromComposerPackage(Package $package): ExtensionInfoInterface
    {
        if (!$this->supportsPackage($package)) {
            throw new UnsupportedExtensionException(
                $package->getName()
            );
        }

        return new ComposerThemeInfo($package);
    }

    /**
     * @inheritDoc
     */
    public function supportsPackage(Package $package): bool
    {
        return $package->getType() === 'impresscms-theme';
    }
}