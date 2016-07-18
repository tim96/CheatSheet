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

    // todo: add realization
}