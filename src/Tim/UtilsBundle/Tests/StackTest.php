<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 7/19/2016
 * Time: 9:11 PM
 */

namespace Tim\UtilsBundle\Tests;

use Tim\UtilsBundle\Algorithms\Stack;

class StackTest extends \PHPUnit_Framework_TestCase
{
    public function testStack()
    {
        $stack = new Stack();
        static::assertTrue($stack->isEmpty());
        static::assertEquals(0, $stack->count());

        $stack->push('one');
        $stack->push('two');
        $stack->push('three');

        static::assertFalse($stack->isEmpty());
        static::assertEquals(3, $stack->count());

        static::assertFalse($stack->contains('four'));

        $stack->push('four');

        static::assertTrue($stack->contains('four'));

        static::assertEquals('four', $stack->top());

        $stack->pop();

        static::assertEquals('three', $stack->top());

        $stack->clear();
        static::assertTrue($stack->isEmpty());
        static::assertEquals(0, $stack->count());
    }
}