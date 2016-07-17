<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 7/14/2016
 * Time: 10:15 PM
 */

namespace Tim\UtilsBundle\Algorithms;

/**
 * Small description:
 *
 * In computer science, a linked list is a linear collection of data elements, called nodes, pointing to the next node
 * by means of a pointer. It is a data structure consisting of a group of nodes which together represent a sequence.
 * Under the simplest form, each node is composed of data and a reference (in other words, a link) to the next node in
 * the sequence. This structure allows for efficient insertion or removal of elements from any position in the sequence
 * during iteration. More complex variants add additional links, allowing efficient insertion or removal from arbitrary
 * element references.
 *
 * The principal benefit of a linked list over a conventional array is that the list elements can easily be inserted
 * or removed without reallocation or reorganization of the entire structure because the data items need not be stored
 * contiguously in memory or on disk, while an array has to be declared in the source code, before compiling and running
 * the program. Linked lists allow insertion and removal of nodes at any point in the list, and can do so with a
 * constant number of operations if the link previous to the link being added or removed is maintained during list
 * traversal.
 *
 * On the other hand, simple linked lists by themselves do not allow random access to the data, or any form of efficient
 * indexing. Thus, many basic operations — such as obtaining the last node of the list (assuming that the last node
 * is not maintained as separate node reference in the list structure), or finding a node that contains a given datum,
 * or locating the place where a new node should be inserted — may require sequential scanning of most or all of the
 * list elements. The advantages and disadvantages of using linked lists are given below.
 *
 * Advantages:
 * - Linked lists are a dynamic data structure, which can grow and be pruned, allocating and deallocating memory
 * while the program is running.
 * - Insertion and deletion node operations are easily implemented in a linked list.
 * - Linear data structures such as stacks and queues are easily executed with a linked list.
 * - They can reduce access time and may expand in real time without memory overhead.
 *
 * Disadvantages:
 * - They use more memory than arrays because of the storage used by their pointers.
 * - Nodes in a linked list must be read in order from the beginning as linked lists are inherently sequential access.
 * - Nodes are stored incontiguously, greatly increasing the time required to access individual elements within the
 * list, especially with a CPU cache.
 * - Difficulties arise in linked lists when it comes to reverse traversing. For instance, singly linked lists are
 * cumbersome to navigate backwards[1] and while doubly linked lists are somewhat easier to read, memory is wasted
 * in allocating space for a back-pointer.
 *
 */

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

    public function getFirstNode()
    {
        return $this->firstNode;
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