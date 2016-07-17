<?php

namespace Tim\UtilsBundle\Tests;

use Tim\UtilsBundle\Algorithms\LinkList;

class LinkListTest extends \PHPUnit_Framework_TestCase
{
    public function testLinkList()
    {
        $totalNodes = 100;
        $theList = new LinkList();

        for ($i = 1; $i <= $totalNodes; $i++) {
            $theList->insertLast($i);
        }
        static::assertEquals($totalNodes, $theList->totalNodes());

        for($i = 1; $i <= $totalNodes; $i++) {
            $theList->insertFirst($i);
        }

        $totalNodes *= 2;
        static::assertEquals($totalNodes, $theList->totalNodes());

        $theList->reverseList();
        static::assertEquals($totalNodes, $theList->totalNodes());

        $theList->deleteFirstNode();
        static::assertEquals($totalNodes - 1, $theList->totalNodes());

        $theList->deleteLastNode();
        static::assertEquals($totalNodes - 2, $theList->totalNodes());

        $theList->deleteNode(7);
        static::assertEquals($totalNodes - 3, $theList->totalNodes());

        $theList->insertLast(17);
        static::assertEquals($totalNodes - 2, $theList->totalNodes());

        $found = $theList->find(15);
        static::assertEquals(15, $found->data);

        $found = $theList->find(112);
        static::assertNull($found);

        $data = $theList->readNode(51);
        static::assertEquals(49, $data);

        $data = $theList->readNode(1024);
        static::assertNull($data);
    }
}