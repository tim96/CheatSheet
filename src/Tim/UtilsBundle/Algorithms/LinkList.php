<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 7/14/2016
 * Time: 10:15 PM
 */

namespace Tim\UtilsBundle\Algorithms;

class LinkList
{
    /**
     * @var ListNode
     */
    private $firstNode;

    /**
     * @var ListNode
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

    public function insertFirst($data)
    {
        $link = new ListNode($data);
        $link->next = $this->firstNode;
        $this->firstNode = &$link;

        if ($this->lastNode === null) {
            $this->lastNode = &$link;
        }

        $this->count++;
    }

    public function insertLast($data)
    {
        if($this->firstNode !== null) {
            $link = new ListNode($data);
            $this->lastNode->next = $link;
            $link->next = NULL;
            $this->lastNode = &$link;

            $this->count++;
        }
        else
        {
            $this->insertFirst($data);
        }
    }

    public function deleteFirstNode()
    {
        $temp = $this->firstNode;
        $this->firstNode = $this->firstNode->next;

        if ($this->firstNode !== null) {
            $this->count--;
        }

        return $temp;
    }

    public function deleteLastNode()
    {
        if ($this->firstNode !== null) {
            if ($this->firstNode->next === null) {
                $this->firstNode = null;
                $this->count--;
            } else {
                $previousNode = $this->firstNode;
                $currentNode = $this->firstNode->next;

                /** @var $currentNode ListNode */
                while($currentNode->next !== null) {
                    $previousNode = $currentNode;
                    $currentNode = $currentNode->next;
                }

                $previousNode->next = null;
                $this->count--;
            }
        }
    }

    public function deleteNode($key)
    {
        $currentNode = $this->firstNode;
        $previousNode = $this->firstNode;

        while($currentNode->data !== $key) {
            if ($currentNode->next === null) {
                return null;
            } else {
                $previousNode = $currentNode;
                $currentNode = $currentNode->next;
            }
        }

        if ($currentNode === $this->firstNode) {
            if ($this->count === 1) {
                $this->lastNode = $this->firstNode;
            }
            $this->firstNode = $this->firstNode->next;
        } else {
            if ($this->lastNode === $currentNode) {
                $this->lastNode = $previousNode;
            }
            $previousNode->next = $currentNode->next;
        }
        $this->count--;
    }

    public function find($key)
    {
        $currentNode = $this->firstNode;
        while($currentNode->data !== $key)
        {
            if ($currentNode->next === NULL) {
                return null;
            }
            else {
                $currentNode = $currentNode->next;
            }
        }
        return $currentNode;
    }

    public function readNode($positionNode)
    {
        if ($positionNode <= $this->count) {
            $currentNode = $this->firstNode;
            $position = 1;
            while($position !== $positionNode) {
                if ($currentNode->next === null) {
                    return null;
                } else {
                    $currentNode = $currentNode->next;
                }

                $position++;
            }

            return $currentNode->data;
        } else {
            return null;
        }
    }

    public function totalNodes()
    {
        return $this->count;
    }

    public function readList()
    {
        $listData = array();
        $current = $this->firstNode;

        while($current !== null) {
            // array_push($listData, $current->readNode());
            $listData[] = $current->readNode();
            $current = $current->next;
        }

        return $listData;
    }

    public function reverseList()
    {
        if($this->firstNode !== null && $this->firstNode->next !== null) {
            $current = $this->firstNode;
            $new = NULL;

            while ($current !== null)
            {
                $temp = $current->next;
                $current->next = $new;
                $new = $current;
                $current = $temp;
            }
            $this->firstNode = $new;
        }
    }

    /**
     * Test function to print content as a list
     */
    public function printAsList()
    {
        $items = $this->readList();
        $str = '';
        foreach($items as $item) {
            $str .= $item . '->';
        }

        return $str;
    }
}