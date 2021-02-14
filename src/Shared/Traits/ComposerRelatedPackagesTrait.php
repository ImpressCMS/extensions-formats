<?php


namespace ImpressCMS\Descriptor\Shared\Traits;

use ImpressCMS\Descriptor\Shared\Elements\RelatedPackage;

/**
 * Helpers functions to deal with related composer packages
 *
 * @package ImpressCMS\Descriptor\Shared\Traits
 */
trait ComposerRelatedPackagesTrait
{

    /**
     * @inheritDoc
     */
    public function getRequiredPackages(): iterable
    {
        $ret = [];

        foreach ($this->package->getRequires() as $link) {
            $ret[] = new RelatedPackage(
                $link->getSource(),
                $link->getConstraint(),
                $link->getDescription()
            );
        }

        return $ret;
    }

    /**
     * @inheritDoc
     */
    public function getSuggestedPackages(): iterable
    {
        $ret = [];

        foreach ($this->package->getSuggests() as $link) {
            $ret[] = new RelatedPackage(
                $link->getSource(),
                $link->getConstraint(),
                $link->getDescription()
            );
        }

        return $ret;
    }

}