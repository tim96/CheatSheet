<?php

namespace Tim\UtilsBundle\Tests;

use Tim\UtilsBundle\Algorithms\DoubleLinkList;

class DoubleLinkListTest extends \PHPUnit_Framework_TestCase
{
    public function testDoubleLinkList()
    {
        $totalNodes = 100;
        $theList = new DoubleLinkList();

        for ($i = 1; $i <= $totalNodes; $i++) {
            $theList->insertFirst($i);
        }
        static::assertEquals($totalNodes, $theList->totalNodes());

        for ($i = 1; $i <= $totalNodes; $i++) {
            $theList->insertLast($i);
        }
        $totalNodes *= 2;
        static::assertEquals($totalNodes, $theList->totalNodes());

        static::assertCount($totalNodes, $theList->readListForward());
        static::assertCount($totalNodes, $theList->readListBackward());

        static::assertInternalType('array', $theList->readListForward());
        static::assertInternalType('array', $theList->readListBackward());
    }
}