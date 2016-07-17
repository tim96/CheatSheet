<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 7/14/2016
 * Time: 10:15 PM
 */

namespace Tim\UtilsBundle\Algorithms;

class ListNode
{
    public $data;
    public $next;

    public function __construct($data)
    {
        $this->data = $data;
        $this->next = NULL;
    }

    public function readNode()
    {
        return $this->data;
    }
}