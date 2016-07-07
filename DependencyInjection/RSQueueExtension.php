<?php

/*
 * This file is part of the RSQueue library
 *
 * Copyright (c) 2016 Marc Morera
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Feel free to edit as you please, and have fun.
 *
 * @author Marc Morera <yuhu@mmoreram.com>
 */

namespace RSQueueBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class RSQueueExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter(
            'rs_queue.queues',
            $config['queues']
        );

        $container->setParameter(
            'rs_queue.serializer.class',
            $config['serializer']
        );

        $container->setParameter(
            'rs_queue.server.redis',
            $config['server']['redis']
        );

        $loader = new Loader\YamlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../Resources/config')
        );

        $loader->load('services.yml');
        $loader->load('collector.yml');
        $loader->load('redis.yml');
        $loader->load('serializers.yml');

        // BC sf < 2.6
        $definition = $container->getDefinition('rs_queue.serializer');
        $definition->setFactory([
            new Reference('rs_queue.serializer.factory'),
            'get',
        ]);

        // BC sf < 2.6
        $definition = $container->getDefinition('rs_queue.redis');
        $definition->setFactory([
            new Reference('rs_queue.redis.factory'),
            'get',
        ]);
    }
}
