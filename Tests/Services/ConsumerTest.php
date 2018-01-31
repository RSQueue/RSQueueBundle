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

/**
 * Class ConsumerTest.
 */
trait ConsumerTest
{
    /**
     * Test that we can produce something and we can consume it.
     *
     * @dataProvider getPayloads
     */
    public function testBasicScenario($payload)
    {
        $redisQueue = 'test_'.rand(0, 100000000000);
        $this->produce($redisQueue, $payload);
        $this->assertEquals(
            [$redisQueue, $payload],
            $this->consume($redisQueue)
        );
    }

    /**
     * get payloads.
     */
    public function getPayloads()
    {
        return [
            [1],
            [['something', 1234, null]],
            [null],
        ];
    }

    /**
     * Test empty queue with timeout.
     */
    public function testEmptyQueueWithTimeout()
    {
        $redisQueue = 'test_'.rand(0, 100000000000);
        $this->assertEquals(
            [],
            $this->consume($redisQueue, 1)
        );
    }

    /**
     * Test n iterations.
     *
     * @param string|string[]
     *
     * @dataProvider getQueues
     */
    public function testNIterations($redisQueue)
    {
        $uniqueRedisQueue = is_array($redisQueue)
            ? $redisQueue[array_rand($redisQueue)]
            : $redisQueue;

        $this->produce($uniqueRedisQueue, 0);
        $this->produce($uniqueRedisQueue, 1);
        $this->produce($uniqueRedisQueue, 2);
        $this->produce($uniqueRedisQueue, 3);
        $this->assertEquals(0, $this->consume($redisQueue)[1]);
        $this->assertEquals(1, $this->consume($redisQueue)[1]);
        $this->assertEquals(2, $this->consume($redisQueue)[1]);
        $this->assertEquals(3, $this->consume($redisQueue)[1]);
        $this->assertEquals([], $this->consume($redisQueue, 1));
    }

    /**
     * Get queues.
     */
    public function getQueues()
    {
        return [
            ['test_'.rand(0, 100000000000)],
        ];
    }
}
