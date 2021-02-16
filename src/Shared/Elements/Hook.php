<?php


namespace ImpressCMS\Descriptor\Shared\Elements;

use Imponeer\Contracts\ExtensionInfo\Elements\HookInterface;

/**
 * Describes hook
 *
 * @package ImpressCMS\Descriptor\Shared\Elements
 */
class Hook implements HookInterface
{
    /**
     * @var string
     */
    private $event;
    /**
     * @var callable
     */
    private $action;

    /**
     * Hook constructor.
     *
     * @param string $event
     * @param callable $action
     */
    public function __construct(string $event, callable $action)
    {
        $this->event = $event;
        $this->action = $action;
    }

    /**
     * Creates hook instance from script file
     *
     * @param string $event Event what for
     * @param string $scriptFile Script file to use as code
     *
     * @return Hook
     */
    public static function fromScriptFile(string $event, string $scriptFile): Hook
    {
        return new self(
            $event,
            function () use ($scriptFile) {
                /** @noinspection PhpIncludeInspection */
                include $scriptFile;
            }
        );
    }

    /**
     * @inheritDoc
     */
    public function getEventName(): string
    {
        return $this->event;
    }

    /**
     * @inheritDoc
     */
    public function getAction(): callable
    {
        return $this->action;
    }
}