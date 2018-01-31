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

namespace RSQueueBundle\Tests;

use Mmoreram\BaseBundle\Tests\BaseFunctionalTest;
use Mmoreram\BaseBundle\Tests\BaseKernel;
use RSQueueBundle\RSQueueBundle;
use RSQueueBundle\Tests\Services\ConsumerTest;
use RSQueueBundle\Tests\Services\ProducerTest;
use RSQueueBundle\Tests\Services\PublisherTest;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Class RSQueueFunctionalTest.
 */
abstract class RSQueueFunctionalTest extends BaseFunctionalTest
{
    use ConsumerTest;
    use ProducerTest;
    use PublisherTest;

    /**
     * Get kernel.
     *
     * @return KernelInterface
     */
    protected static function getKernel(): KernelInterface
    {
        return new BaseKernel(
            [RSQueueBundle::class],
            [
                'rs_queue' => [
                    'server' => [
                        'redis' => static::getRedisConfiguration(),
                    ],
                ],
            ],
            []
        );
    }

    /**
     * Get redis configuration.
     *
     * @return array
     */
    abstract public static function getRedisConfiguration(): array;

    /**
     * Produce.
     *
     * @param string $queue
     * @param mixed  $payload
     */
    protected function produce(
        string $queue,
        $payload
    ) {
        $this
            ->get('rs_queue.producer')
            ->produce($queue, $payload);
    }

    /**
     * Consume.
     *
     * @param string|string[] $queue
     * @param int             $timeout
     *
     * @return array
     */
    protected function consume(
        $queue,
        int $timeout = 0
    ): array {
        return $this
            ->get('rs_queue.consumer')
            ->consume($queue, $timeout);
    }
}
