<?php

namespace ImpressCMS\Descriptor\Module;

use Composer\Package\Package;
use Imponeer\Contracts\ExtensionInfo\Exceptions\UnsupportedExtensionException;
use Imponeer\Contracts\ExtensionInfo\ExtensionInfoFactoryInterface;
use Imponeer\Contracts\ExtensionInfo\ExtensionInfoInterface;
use Imponeer\Contracts\ExtensionInfo\Factory\FromComposerPackageFactoryInterface;
use Imponeer\Contracts\ExtensionInfo\Factory\FromPathFactoryInterface;
use ImpressCMS\Descriptor\Shared\Traits\ComposerFactoryTrait;

/**
 * Factory to make module composer info readers
 *
 * @package ImpressCMS\Descriptor\Module
 */
class ComposerModuleInfoFactory implements ExtensionInfoFactoryInterface, FromPathFactoryInterface, FromComposerPackageFactoryInterface
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

        return new ComposerModuleInfo($package);
    }

    /**
     * @inheritDoc
     */
    public function getSupportedPackageTypes(): array
    {
        return (array)'impresscms-module';
    }
}