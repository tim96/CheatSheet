<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 7/18/2016
 * Time: 9:13 PM
 */

namespace Tim\UtilsBundle\Algorithms;

class DoubleLinkList
{
    /**
     * @var DoubleListNode
     */
    private $firstNode;

    /**
     * @var DoubleListNode
     */
    private $lastNode;

    /**
     * @var integer
     */
    private $count;

    public function __construct()
    {
        $this->firstNode = null;
        $this->lastNode = null;
        $this->count = 0;
    }

    public function isEmpty()
    {
        return (null === $this->firstNode);
    }

    public function totalNodes()
    {
        return $this->count;
    }

    public function insertFirst($data)
    {
        $newLink = new DoubleListNode($data);

        if ($this->isEmpty()) {
            $this->lastNode = $newLink;
        } else {
            $this->firstNode->previous = $newLink;
        }

        $newLink->next = $this->firstNode;
        $this->firstNode = $newLink;
        $this->count++;
    }

    public function insertLast($data)
    {
        $newLink = new DoubleListNode($data);

        if ($this->isEmpty()) {
            $this->firstNode = $newLink;
        } else {
            $this->lastNode->next = $newLink;
        }

        $newLink->previous = $this->lastNode;
        $this->lastNode = $newLink;
        $this->count++;
    }

    public function readListForward()
    {
        $listData = array();
        $current = $this->firstNode;

        while($current !== null) {
            $listData[] = $current->readNode();
            $current = $current->next;
        }

        return $listData;
    }

    public function readListBackward()
    {
        $listData = array();
        $current = $this->lastNode;

        while($current !== null) {
            $listData[] = $current->readNode();
            $current = $current->previous;
        }

        return $listData;
    }

    // todo: add realization

    /**
     * Test function to print content as a list
     */
    public function printAsList()
    {
        $items = $this->readListForward();
        $str = '';
        foreach($items as $item) {
            $str .= $item . '->';
        }

        return $str;
    }
}