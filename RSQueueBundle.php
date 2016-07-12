<?php

namespace RSQueueBundle;

use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

use RSQueueBundle\DependencyInjection\RSQueueExtension;

/**
 * Main RSQueueBundle class
 */
class RSQueueBundle extends Bundle
{
    /**
     * Returns the bundle's container extension.
     *
     * @return ExtensionInterface|null The container extension
     *
     * @throws \LogicException
     */
    public function getContainerExtension()
    {
        return new RSQueueExtension($this);
    }
}
