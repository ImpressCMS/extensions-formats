<?php

namespace ImpressCMS\Descriptor\Shared\Traits;

use Composer\Package\CompletePackageInterface;
use Imponeer\Contracts\ExtensionInfo\Enum\ExtensionState;
use Imponeer\Contracts\ExtensionInfo\Enum\ScreenshotType;
use ImpressCMS\Descriptor\Shared\Elements\Screenshot;
use League\Flysystem\Filesystem;
use League\Flysystem\Local\LocalFilesystemAdapter;

/**
 * Helps easier to define info getter for composer package
 *
 * @package ImpressCMS\Descriptor\Shared\Traits
 */
trait ComposerPackageReaderTrait
{
    use ComposerLinksTrait, ComposerTeamMemberTrait, ComposerRelatedPackagesTrait;

    /**
     * @var CompletePackageInterface
     */
    protected $package;

    /**
     * ComposerThemeInfo constructor.
     *
     * @param CompletePackageInterface $package
     */
    public function __construct(CompletePackageInterface $package)
    {
        $this->package = $package;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->getExtraValue(
            'name',
            $this->package->getName()
        );
    }

    /**
     * Gets data from extra package info
     *
     * @param string $name Name of extra key
     * @param mixed $default Default value
     *
     * @return mixed
     */
    protected function getExtraValue(string $name, $default = null)
    {
        static $extra = null;
        if ($extra === null) {
            $extra = $this->package->getExtra();
        }
        return $extra[$name] ?? $default;
    }

    /**
     * @inheritDoc
     */
    public function getLicense(): array
    {
        return (array)$this->package->getLicense();
    }

    /**
     * @inheritDoc
     */
    public function getDescription(): string
    {
        return $this->package->getDescription();
    }

    /**
     * @inheritDoc
     */
    public function getVersion(): string
    {
        return $this->package->getVersion();
    }

    /**
     * @inheritDoc
     */
    public function getReleaseDate(): ?DateTime
    {
        return $this->package->getReleaseDate();
    }

    /**
     * @inheritDoc
     */
    public function getState(): ExtensionState
    {
        return $this->package->isAbandoned() ? ExtensionState::ABANDONED() : ExtensionState::ACTIVE();
    }

    /**
     * @inheritDoc
     */
    public function getFiles(): ?Filesystem
    {
        return new Filesystem(
            new LocalFilesystemAdapter(
                $this->getPath()
            )
        );
    }

    /**
     * @inheritDoc
     */
    public function getPath(): string
    {
        return $this->package->getTargetDir();
    }

    /**
     * Gets screenshots
     *
     * @return Screenshot[]
     */
    public function getScreenshots(): array
    {
        $ret = [];

        $screenshots = (array)$this->getExtraValue('screenshots', []);

        if (isset($screenshots['admin'])) {
            foreach ((array)$screenshots['admin'] as $url) {
                $ret[] = new Screenshot(
                    ScreenshotType::ADMIN_SIDE(),
                    $url
                );
            }
        }

        if (isset($screenshots['user'])) {
            foreach ((array)$screenshots['user'] as $url) {
                $ret[] = new Screenshot(
                    ScreenshotType::USER_SIDE(),
                    $url
                );
            }
        }

        return $ret;
    }

}