<?php

namespace ImpressCMS\Descriptor\Theme\Composer;

use Imponeer\Contracts\ExtensionInfo\Enum\ExtensionType;
use Imponeer\Contracts\ExtensionInfo\Enum\ScreenshotType;
use ImpressCMS\Descriptor\Shared\Elements\Screenshot;
use ImpressCMS\Descriptor\Shared\Traits\ComposerPackageReaderTrait;
use ImpressCMS\Descriptor\Shared\Traits\ImpressCMSExtensionTrait;

/**
 * Describes theme from composer
 *
 * @package ImpressCMS\Descriptor\Theme\Composer
 */
class ComposerThemeInfo implements \ImpressCMS\Descriptor\Theme\ThemeInfoInterface
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
     * Gets screenshots
     *
     * @return Screenshot[]
     */
    public function getScreenshots(): array
    {
        $ret = [];

        $screenshots = $this->getExtraValue('screenshots', []);

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