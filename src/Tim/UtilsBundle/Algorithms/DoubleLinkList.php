<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 7/18/2016
 * Time: 9:13 PM
 */

namespace Tim\UtilsBundle\Algorithms;

/**
 * Small description:
 *
 * In computer science, a doubly linked list is a linked data structure that consists of a set of sequentially linked
 * records called nodes. Each node contains two fields, called links, that are references to the previous and to the
 * next node in the sequence of nodes. The beginning and ending nodes' previous and next links, respectively, point to
 * some kind of terminator, typically a sentinel node or null, to facilitate traversal of the list. If there is only
 * one sentinel node, then the list is circularly linked via the sentinel node. It can be conceptualized as two singly
 * linked lists formed from the same data items, but in opposite sequential orders.
 * The two node links allow traversal of the list in either direction. While adding or removing a node in a doubly
 * linked list requires changing more links than the same operations on a singly linked list, the operations are simpler
 * and potentially more efficient (for nodes other than first nodes) because there is no need to keep track of the
 * previous node during traversal or no need to traverse the list to find the previous node, so that its link can
 * be modified.
 *
 * The first and last nodes of a doubly linked list are immediately accessible (i.e., accessible without traversal,
 * and usually called head and tail) and therefore allow traversal of the list from the beginning or end of the list,
 * respectively: e.g., traversing the list from beginning to end, or from end to beginning, in a search of the list for
 * a node with specific data value. Any node of a doubly linked list, once obtained, can be used to begin a new
 * traversal of the list, in either direction (towards beginning or end), from the given node.
 *
 * The link fields of a doubly linked list node are often called next and previous or forward and backward.
 * The references stored in the link fields are usually implemented as pointers, but (as in any linked data structure)
 * they may also be address offsets or indices into an array where the nodes live.
 *
 */
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