<?php

namespace ImpressCMS\Descriptor\Theme;

use Imponeer\Contracts\ExtensionInfo\Enum\ExtensionType;
use ImpressCMS\Descriptor\Shared\Traits\ComposerPackageReaderTrait;
use ImpressCMS\Descriptor\Shared\Traits\ImpressCMSExtensionTrait;

/**
 * Describes theme from composer
 *
 * @package ImpressCMS\Descriptor\Theme
 */
class ComposerThemeInfo implements ThemeInfoInterface
{
    use ComposerPackageReaderTrait, ImpressCMSExtensionTrait;

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
    public function hasAdmin(): bool
    {
        $screenshots = $this->getExtraValue('screenshots', []);
        return isset($screenshots['admin']) && !empty($screenshots['admin']);
    }

    /**
     * @inheritDoc
     */
    public function hasUser(): bool
    {
        $screenshots = $this->getExtraValue('screenshots', []);
        return isset($screenshots['user']) && !empty($screenshots['user']);
    }
}