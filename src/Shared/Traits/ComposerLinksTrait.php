<?php

namespace ImpressCMS\Descriptor\Shared\Traits;

use Imponeer\Contracts\ExtensionInfo\Enum\LinkType;
use ImpressCMS\Descriptor\Shared\Elements\Link;

/**
 * Trait for helping to generate links list
 *
 * @package ImpressCMS\Descriptor\Shared\Traits
 */
trait ComposerLinksTrait
{
    /**
     * @inheritDoc
     */
    public function getLinks(): array
    {
        return array_merge(
            $this->getSupportLinks(),
            $this->getFundingLinks(),
            $this->getVCSLinks()
        );
    }

    /**
     * Gets support links
     *
     * @return Link[]
     */
    protected function getSupportLinks(): array
    {
        $ret = [];

        $mapping = [
            'email' => 'EMAIL',
            'issues' => 'ISSUES_TRACKER',
            'forum' => 'FORUM',
            'wiki' => 'WIKI',
            'irc' => 'IRC',
            'source' => 'SOURCE_CODE_PAGE',
            'docs' => 'DOCUMENTATION',
            'rss' => 'RSS',
            'chat' => 'WEB_CHAT',
        ];

        $support = $this->package->getSupport();
        foreach ($mapping as $key => $enumName) {
            if (!isset($support[$key])) {
                continue;
            }
            $ret[] = new Link(
                LinkType::$enumName(),
                $support[$key]
            );
        }

        return $ret;
    }

    /**
     * Gets funding links
     *
     * @return Link[]
     */
    protected function getFundingLinks(): array
    {
        $ret = [];
        foreach ($this->package->getFunding() as $funding) {
            $ret[] = new Link(
                LinkType::FUNDING_PAGE(),
                $funding['url']
            );
        }
        return $ret;
    }

    /**
     * Gets version control links
     *
     * @return Link[]
     */
    protected function getVCSLinks(): array
    {
        $ret = [];

        foreach ($this->package->getSourceUrls() as $sourceUrl) {
            $ret[] = new Link(
                LinkType::VERSION_CONTROL(),
                $sourceUrl
            );
        }

        return $ret;
    }

}