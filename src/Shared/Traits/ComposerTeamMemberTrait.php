<?php


namespace ImpressCMS\Descriptor\Shared\Traits;

use Imponeer\Contracts\ExtensionInfo\Enum\LinkType;
use Imponeer\Contracts\ExtensionInfo\Enum\MemberRole;
use ImpressCMS\Descriptor\Shared\Elements\Link;
use ImpressCMS\Descriptor\Shared\Elements\TeamMember;

/**
 * Helps list all composer team members
 *
 * @package ImpressCMS\Descriptor\Shared\Traits
 */
trait ComposerTeamMemberTrait
{

    /**
     * @inheritDoc
     */
    public function getTeamMembers(): array
    {
        $ret = [];

        foreach ($this->package->getAuthors() as $author) {
            $ret[] = $this->convertAuthorToTeamMember($author);
        }

        return $ret;
    }

    /**
     * Converts author to team member
     *
     * @param array $author Composer author data
     *
     * @return TeamMember
     */
    protected function convertAuthorToTeamMember(array $author): TeamMember
    {
        $links = [];
        if (isset($author['email'])) {
            $links[] = new Link(
                LinkType::EMAIL(),
                $author['email']
            );
        }
        if (isset($author['homepage'])) {
            $links[] = new Link(
                LinkType::HOMEPAGE(),
                $author['homepage']
            );
        }

        $role = strtoupper($author['role']);
        $roles = [
            MemberRole::isValidKey($role) ? MemberRole::$role() : MemberRole::UNKNOWN()
        ];

        return new TeamMember($author['name'], $links, $roles);
    }
}