<?php

namespace ImpressCMS\Descriptor\Shared\Traits;

/**
 * Base methods for ImpressCMS extension trait
 *
 * @package ImpressCMS\Descriptor\Shared\Traits
 */
trait ImpressCMSExtensionTrait
{

    /**
     * @inheritDoc
     */
    public function getWhatFor(): string
    {
        return 'ImpressCMS';
    }

}