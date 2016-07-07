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

namespace RSQueueBundle\Tests\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;

use RSQueueBundle\DependencyInjection\RSQueueExtension;

/**
 * RSQueueExtension test.
 *
 * @author Ener-Getick <egetick@gmail.com>
 */
class RSQueueExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ContainerBuilder
     */
    private $container;

    /**
     * @var RSQueueExtension
     */
    private $extension;

    /**
     * Setup.
     */
    public function setUp()
    {
        $this->container = new ContainerBuilder();
        $this->extension = new RSQueueExtension();
    }

    /**
     * Test extension.
     */
    public function testExtension()
    {
        $config = [];
        $this->extension->load($config, $this->container);
    }
}
