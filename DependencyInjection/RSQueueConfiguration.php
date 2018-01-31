<?php

/*
 * This file is part of the RSQueue library
 *
 * Copyright (c) 2016 - now() Marc Morera
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Feel free to edit as you please, and have fun.
 *
 * @author Marc Morera <yuhu@mmoreram.com>
 */

declare(strict_types=1);

namespace RSQueueBundle\DependencyInjection;

use Mmoreram\BaseBundle\DependencyInjection\BaseConfiguration;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * Class RSQueueConfiguration.
 */
class RSQueueConfiguration extends BaseConfiguration
{
    /**
     * Configure the root node.
     *
     * @param ArrayNodeDefinition $rootNode Root node
     */
    protected function setupTree(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('queues')
                    ->prototype('scalar')->end()
                ->end()
                ->scalarNode('serializer')
                    ->treatNullLike('RSQueue\\Serializer\\JsonSerializer')
                    ->defaultValue('RSQueue\\Serializer\\JsonSerializer')
                ->end()
                ->arrayNode('server')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('redis')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('cluster')
                                    ->defaultFalse()
                                ->end()
                                ->scalarNode('host')
                                    ->defaultValue('127.0.0.1')
                                ->end()
                                ->scalarNode('port')
                                    ->defaultValue(6379)
                                ->end()
                                ->scalarNode('database')
                                    ->defaultNull()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
}
