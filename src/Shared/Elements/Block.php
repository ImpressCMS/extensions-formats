<?php

namespace ImpressCMS\Descriptor\Shared\Elements;

use Imponeer\Contracts\ExtensionInfo\Elements\BlockInterface;
use Imponeer\Contracts\ExtensionInfo\Elements\TemplateInterface;

/**
 * Defines a block
 *
 * @package ImpressCMS\Descriptor\Shared\Elements
 */
class Block implements BlockInterface
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $description;
    /**
     * @var string|null
     */
    private $template;
    /**
     * @var ?callable
     */
    private $showFunc;
    /**
     * @var ?callable
     */
    private $editFunc;
    /**
     * @var mixed
     */
    private $options;

    /**
     * Block constructor.
     *
     * @param string $name
     * @param string $description
     * @param string|null $template
     * @param callable|null $showFunc
     * @param callable|null $editFunc
     * @param mixed $options
     */
    public function __construct(
        string $name,
        string $description,
        ?string $template,
        ?callable $showFunc,
        ?callable $editFunc,
        $options
    )
    {
        $this->name = $name;
        $this->description = $description;
        $this->template = $template;
        $this->showFunc = $showFunc;
        $this->editFunc = $editFunc;
        $this->options = $options;
    }

    /**
     * Makes block instance from array
     *
     * @param string $extensionPath Extension path
     * @param array $block Block data
     *
     * @return Block
     */
    public static function fromArray(string $extensionPath, array $block): Block
    {
        return new Block(
            $block['name'],
            $block['description'] ?? '',
            $block['template'] ? $extensionPath . DIRECTORY_SEPARATOR . $block['template'] : null,
            self::makeBlockCallable($extensionPath, 'show_func', $block),
            self::makeBlockCallable($extensionPath, 'edit_func', $block),
            $block['options'] ?? null
        );
    }

    /**
     * Makes blocks callable
     *
     * @param string $extensionPath Path where extension is located
     * @param string $key Key in block data array
     * @param array $blockData Block data
     *
     * @return callable|null
     */
    protected static function makeBlockCallable(string $extensionPath, string $key, array $blockData): ?callable
    {
        if (!isset($blockData[$key])) {
            return null;
        }

        $blockFuncName = $blockData[$key];
        $blockPathFile = $extensionPath . DIRECTORY_SEPARATOR . $blockData['file'];

        return static function () use ($blockFuncName, $blockPathFile) {
            /** @noinspection PhpIncludeInspection */
            require_once $blockPathFile;

            return call_user_func_array(
                $blockFuncName,
                func_get_args()
            );
        };
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @inheritDoc
     */
    public function getTemplate(): ?TemplateInterface
    {
        return $this->template ? null : new Template($this->template);
    }

    /**
     * @inheritDoc
     */
    public function getShowCallback(): ?callable
    {
        return $this->showFunc;
    }

    /**
     * @inheritDoc
     */
    public function getEditCallback(): ?callable
    {
        return $this->editFunc;
    }

    /**
     * @inheritDoc
     */
    public function getOptions()
    {
        return (string)$this->options;
    }

}