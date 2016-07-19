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

        $theList->insertAfter(25, 1024);
        static::assertEquals($totalNodes + 1, $theList->totalNodes());

        $data = $theList->readListForward();
        static::assertEquals(1024, $data[100 - 25 + 1]);

        $theList->deleteFirstNode();
        static::assertEquals($totalNodes, $theList->totalNodes());

        $theList->deleteLastNode();
        static::assertEquals($totalNodes - 1, $theList->totalNodes());

        $theList->deleteLastNode();
        static::assertEquals($totalNodes - 2, $theList->totalNodes());

        $theList->deleteNode(25);
        static::assertEquals($totalNodes - 3, $theList->totalNodes());

        $theList->deleteNode(10000);
        static::assertEquals($totalNodes - 3, $theList->totalNodes());
    }

    /**
     * For work with data structures in PHP exists extension SPL;
     * http://php.net/manual/en/spl.datastructures.php
     *
     * A Doubly Linked List (DLL) is a list of nodes linked in both directions to each other.
     * Iterator's operations, access to both ends, addition or removal of nodes have a cost of O(1) when the
     * underlying structure is a DLL. It hence provides a decent implementation for stacks and queues.
     */
    public function testSplDoublyLinkedList()
    {
        $totalNodes = 100;
        $theList = new \SplDoublyLinkedList();

        for ($i = 1; $i <= $totalNodes; $i++) {
            $theList->unshift($i);
        }
        static::assertEquals($totalNodes, $theList->count());

        for ($i = 1; $i <= $totalNodes; $i++) {
            $theList->push($i);
        }
        $totalNodes *= 2;
        static::assertEquals($totalNodes, $theList->count());

        $items = array();
        $theList->setIteratorMode(\SplDoublyLinkedList::IT_MODE_FIFO);
        for ($theList->rewind(); $theList->valid(); $theList->next()) {
            $items[] = $theList->key();
        }
        static::assertCount($totalNodes, $items);

        $theList->shift();
        static::assertEquals($totalNodes - 1, $theList->count());

        $theList->pop();
        static::assertEquals($totalNodes - 2, $theList->count());

        $theList->pop();
        static::assertEquals($totalNodes - 3, $theList->count());

        $theList->offsetUnset(25);
        static::assertEquals($totalNodes - 4, $theList->count());

        $this->setExpectedException(\OutOfRangeException::class);
        $theList->offsetUnset(10000);
    }
}