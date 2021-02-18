<?php


namespace ImpressCMS\Descriptor\Module;

use Imponeer\Contracts\ExtensionInfo\Enum\ExtensionType;
use ImpressCMS\Descriptor\Shared\Elements\Block;
use ImpressCMS\Descriptor\Shared\Elements\Hook;
use ImpressCMS\Descriptor\Shared\Elements\Icon;
use ImpressCMS\Descriptor\Shared\Elements\RelatedPackage;
use ImpressCMS\Descriptor\Shared\Elements\Template;
use ImpressCMS\Descriptor\Shared\Traits\ComposerPackageReaderTrait;
use ImpressCMS\Descriptor\Shared\Traits\ImpressCMSExtensionTrait;
use ImpressCMS\Descriptor\Shared\Traits\LegacyAssetsTrait;

/**
 * Defines composer module info
 *
 * @package ImpressCMS\Descriptor\Module
 */
class ComposerModuleInfo implements ModuleInfoInterface
{
    use ComposerPackageReaderTrait, ImpressCMSExtensionTrait, LegacyAssetsTrait;

    /**
     * @inheritDoc
     */
    public function getType(): ExtensionType
    {
        return ExtensionType::MODULE();
    }

    /**
     * @inheritDoc
     */
    public function getReplaces(): iterable
    {
        foreach ($this->package->getReplaces() as $link) {
            yield new RelatedPackage(
                $link->getSource(),
                $link->getConstraint(),
                $link->getDescription()
            );
        }
    }

    /**
     * @inheritDoc
     */
    public function getConflictedPackages(): iterable
    {
        foreach ($this->package->getConflicts() as $link) {
            yield new RelatedPackage(
                $link->getTarget(),
                $link->getConstraint(),
                $link->getDescription()
            );
        }
    }

    /**
     * @inheritDoc
     */
    public function getHooks(): iterable
    {
        $eventsScripts = (array)$this->getExtraValue('events', []);
        $ret = [];

        foreach (['update', 'install', 'remove'] as $event) {
            if (isset($eventsScripts[$event])) {
                foreach ((array)$eventsScripts[$event] as $script) {
                    $ret[] = Hook::fromScriptFile('update', $script);
                }
            }
        }

        return $ret;
    }

    /**
     * @inheritDoc
     */
    public function getIcons(): iterable
    {
        $ret = [];
        $icons = (array)$this->getExtraValue('icons', []);

        foreach (['big', 'small'] as $cat) {
            if (isset($icons[$cat])) {
                $ret[] = new Icon(
                    $this->getPath() . DIRECTORY_SEPARATOR . $icons[$cat],
                    $cat
                );
            }
        }

        return $ret;
    }

    /**
     * @inheritDoc
     */
    public function getTemplates(): iterable
    {
        foreach ((array)$this->getExtraValue('templates', []) as $template) {
            if (is_array($template)) {
                yield new Template(
                    $this->getPath() . DIRECTORY_SEPARATOR . $template['file'],
                    $template['description'] ?? ''
                );
            } else {
                yield new Template(
                    $this->getPath() . DIRECTORY_SEPARATOR . $template
                );
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function isOfficial(): bool
    {
        /**
         * XoopsCube similar things did for this value so probably we do not need that too
         * @see https://xoopscube.org/modules/wiki/?XOOPSCubeLegacy%2FReference%2Fxoops_version#o11a0915
         */
        return false;
    }

    /**
     * @inheritDoc
     */
    public function getObjectItems(): array
    {
        return (array)$this->getExtraValue('object_items', []);
    }

    /**
     * @inheritDoc
     */
    public function getWarning(): ?string
    {
        return $this->getExtraValue('warning', null);
    }

    /**
     * @inheritDoc
     */
    public function getBlocks(): iterable
    {
        foreach ((array)$this->getExtraValue('blocks', []) as $block) {
            yield Block::fromArray(
                $this->getPath(),
                $block
            );
        }
    }

    /**
     * @inheritDoc
     */
    public function getCommentsPlaces(): iterable
    {
        $comments = (array)$this->getExtraValue('comments', []);
        if (!empty($comments)) {
            // todo
        }
    }

    /**
     * @inheritDoc
     */
    public function getCronJobs(): iterable
    {
    }

    /**
     * @inheritDoc
     */
    public function getNotificationsCategories(): iterable
    {
    }

    /**
     * @inheritDoc
     */
    public function getNotificationsEvents(): iterable
    {
    }

    /**
     * @inheritDoc
     */
    public function getUserConfigItems(): iterable
    {
    }

    /**
     * @inheritDoc
     */
    public function getSearchBuild(): ?callable
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function getSearchExecute(): ?callable
    {
        $search = (array)$this->getExtraValue('search', []);
        $file = isset($search['file']) ? $this->getPath() . DIRECTORY_SEPARATOR . $search['file'] : null;
        $func = $search['func'] ?? null;

        if (!$func) {
            return null;
        }

        return static function () use ($func, $file) {
            if ($file) {
                require_once $file;
            }

            return call_user_func_array($func, func_get_args());
        };
    }
}