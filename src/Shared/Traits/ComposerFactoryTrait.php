<?php

namespace ImpressCMS\Descriptor\Shared\Traits;

use Composer\Factory;
use Composer\IO\IOInterface;
use Composer\IO\NullIO;
use Composer\Package\Package;
use Composer\Package\RootPackageInterface;
use Imponeer\Contracts\ExtensionInfo\ExtensionInfoInterface;

/**
 * Trait that helps to build composer based factories
 *
 * @package ImpressCMS\Descriptor\Shared\Traits
 */
trait ComposerFactoryTrait
{

    /**
     * @var string
     */
    protected $composerDataStorePath;
    /**
     * @var IOInterface
     */
    protected $io;

    /**
     * ComposerThemeInfoFactory constructor.
     *
     * @param string $composerDataStorePath
     */
    public function __construct(string $composerDataStorePath, ?IOInterface $IO = null)
    {
        $this->composerDataStorePath = $composerDataStorePath;
        $this->io = $IO ?? new NullIO();
    }

    /**
     * @inheritDoc
     */
    public function createFromPath(string $path): ExtensionInfoInterface
    {
        return $this->createFromComposerPackage(
            $this->readPathAsComposerPackage($path)
        );
    }

    /**
     * Reads path as composer package
     *
     * @param string $path Path where package exists
     *
     * @return RootPackageInterface
     */
    protected function readPathAsComposerPackage(string $path)
    {
        chdir($path);
        putenv('COMPOSER_HOME=' . $this->composerDataStorePath);
        $composer = Factory::create($this->io);

        return $composer->getPackage();
    }

    /**
     * @inheritDoc
     */
    public function supportsPath(string $path): bool
    {
        if (!file_exists($path . DIRECTORY_SEPARATOR . 'composer.json')) {
            return false;
        }

        return $this->supportsPackage(
            $this->readPathAsComposerPackage($path)
        );
    }

    /**
     * @inheritDoc
     */
    public function supportsPackage(Package $package): bool
    {
        return $package->getType() === $this->getSupportedPackageTypes()[0];
    }

}