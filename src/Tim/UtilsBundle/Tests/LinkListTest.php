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
    }
}