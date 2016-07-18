<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 7/18/2016
 * Time: 9:08 PM
 */

namespace Tim\UtilsBundle\Algorithms;

class DoubleListNode
{
    public $data;
    public $next;
    public $previous;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function readNode()
    {
        return $this->data;
    }
}