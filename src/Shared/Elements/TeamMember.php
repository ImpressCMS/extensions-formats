<?php

namespace ImpressCMS\Descriptor\Shared\Elements;

use Imponeer\Contracts\ExtensionInfo\Enum\MemberRole;

/**
 * Defines team member
 *
 * @package ImpressCMS\Descriptor\Shared\Elements
 */
class TeamMember implements \Imponeer\Contracts\ExtensionInfo\Elements\MemberInterface
{

    /**
     * @var string
     */
    private $name;
    /**
     * @var array
     */
    private $links;
    /**
     * @var array
     */
    private $roles;

    /**
     * TeamMember constructor.
     *
     * @param string $name
     * @param Link[] $links
     * @param MemberRole[] $roles
     */
    public function __construct(string $name, array $links, array $roles)
    {
        $this->name = $name;
        $this->links = $links;
        $this->roles = $roles;
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
    public function getLinks(): array
    {
        return $this->links;
    }

    /**
     * @inheritDoc
     */
    public function getRoles(): array
    {
        return $this->roles;
    }
}