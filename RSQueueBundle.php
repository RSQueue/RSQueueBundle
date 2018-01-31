<?php

namespace RSQueueBundle;

use Mmoreram\BaseBundle\BaseBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;

use RSQueueBundle\DependencyInjection\RSQueueExtension;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Main RSQueueBundle class
 */
class RSQueueBundle extends BaseBundle
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
        return new RSQueueExtension();
    }

    /**
     * Return all bundle dependencies.
     *
     * Values can be a simple bundle namespace or its instance
     *
     * @return array
     */
    public static function getBundleDependencies(KernelInterface $kernel) : array
    {
        return [
            FrameworkBundle::class
        ];
    }
}
