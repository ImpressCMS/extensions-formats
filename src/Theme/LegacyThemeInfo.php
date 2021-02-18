<?php

namespace ImpressCMS\Descriptor\Theme;

use DateTime;
use Imponeer\Contracts\ExtensionInfo\Enum\ExtensionState;
use Imponeer\Contracts\ExtensionInfo\Enum\ExtensionType;
use ImpressCMS\Descriptor\Shared\Traits\ImpressCMSExtensionTrait;
use ImpressCMS\Descriptor\Shared\Traits\LegacyAssetsTrait;
use League\Flysystem\Filesystem;
use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\StorageAttributes;

/**
 * Describes legacy theme
 *
 * @package ImpressCMS\Descriptor\Theme
 */
class LegacyThemeInfo implements ThemeInfoInterface
{
    use ImpressCMSExtensionTrait, LegacyAssetsTrait;

    /**
     * @var string
     */
    private $path;
    /**
     * @var string
     */
    private $modulePath;

    /**
     * LegacyThemeInfo constructor.
     *
     * @param string $path Path where theme is located
     * @param string $modulePath ImpressCMS module path
     */
    public function __construct(string $path, string $modulePath)
    {
        $this->path = $path;
        $this->modulePath = $modulePath;
    }

    /**
     * @inheritDoc
     */
    public function getType(): ExtensionType
    {
        return ExtensionType::THEME();
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return basename($this->path);
    }

    /**
     * @inheritDoc
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @inheritDoc
     *
     * @todo Make it autodetect
     */
    public function getLicense(): array
    {
        return (array)'gplv2-or-later'; // ImpressCMS legacy themes are usually based on GPLv2 or later license - so for now using this as value
    }

    /**
     * @inheritDoc
     */
    public function getDescription(): string
    {
        return '';
    }

    /**
     * @inheritDoc
     */
    public function getVersion(): string
    {
        return '0.0.0';
    }

    /**
     * @inheritDoc
     */
    public function getReleaseDate(): ?DateTime
    {
        $lastModifications = $this
            ->getFiles()
            ->listContents('/', Filesystem::LIST_DEEP)
            ->filter(function (StorageAttributes $attributes) {
                return $attributes->isFile();
            })
            ->map(function (StorageAttributes $attributes) {
                return (int)$attributes->lastModified();
            })->toArray();

        return new DateTime(
            max($lastModifications)
        );
    }

    /**
     * @inheritDoc
     */
    public function getFiles(): ?Filesystem
    {
        return new Filesystem(
            new LocalFilesystemAdapter(
                $this->path
            )
        );
    }

    /**
     * @inheritDoc
     */
    public function getLinks(): array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function getState(): ExtensionState
    {
        return ExtensionState::UNKNOWN();
    }

    /**
     * @inheritDoc
     */
    public function getTeamMembers(): array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function getRequiredPackages(): iterable
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function getSuggestedPackages(): iterable
    {
        return [];
    }

    public function getScreenshots(): array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function hasAdmin(): bool
    {
        return $this->isInModulePath() ? file_exists($this->path . DIRECTORY_SEPARATOR . 'theme.html') : file_exists($this->path . DIRECTORY_SEPARATOR . 'theme_admin.html');
    }

    /**
     * Is theme in Module path?
     *
     * @return bool
     */
    public function isInModulePath(): bool
    {
        return strpos($this->path, $this->modulePath) === 0;
    }

    /**
     * @inheritDoc
     */
    public function hasUser(): bool
    {
        return file_exists($this->path . DIRECTORY_SEPARATOR . 'theme.html') && !$this->isInModulePath();
    }
}