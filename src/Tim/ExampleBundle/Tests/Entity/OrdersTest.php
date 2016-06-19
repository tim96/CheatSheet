<?php

namespace Tim\ExampleBundle\Tests\Entity;

use Tim\ExampleBundle\Entity\Orders;

class OrdersTest extends \PHPUnit_Framework_TestCase
{
    public function testToString()
    {
        $order = new Orders();

        self::assertEquals('', $order->__toString());
        self::assertEquals('', (string)$order);
        self::assertNotEquals(null, $order->getCreatedAt());
        self::assertEquals(null, $order->getUpdatedAt());
    }
}











