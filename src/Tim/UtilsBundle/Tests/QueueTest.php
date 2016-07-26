<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 7/19/2016
 * Time: 9:11 PM
 */

namespace Tim\UtilsBundle\Tests;

use Tim\UtilsBundle\Algorithms\Queue;

class QueueTest extends \PHPUnit_Framework_TestCase
{
    public function testQueue()
    {
        $queue = new Queue();
        static::assertTrue($queue->isEmpty());
        static::assertEquals(0, $queue->count());

        $queue->enqueue('one');
        $queue->enqueue('two');
        $queue->enqueue('three');

        static::assertFalse($queue->isEmpty());
        static::assertEquals(3, $queue->count());

        static::assertFalse($queue->contains('four'));

        $queue->enqueue('four');

        static::assertTrue($queue->contains('four'));

        static::assertEquals('one', $queue->peek());

        $queue->dequeue();

        static::assertEquals('two', $queue->peek());

        $queue->clear();
        static::assertTrue($queue->isEmpty());
        static::assertEquals(0, $queue->count());
    }
}