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

namespace RSQueueBundle\Tests\Services;

use RSQueue\Services\Producer;

/**
 * Class ProducerTest.
 */
trait ProducerTest
{
    /**
     * Test that publisher service exists.
     */
    public function testProducerExists()
    {
        $this->assertInstanceOf(
            Producer::class,
            $this->get('rs_queue.producer')
        );
    }
}
