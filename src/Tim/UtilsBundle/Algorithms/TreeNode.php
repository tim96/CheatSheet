<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 7/19/2016
 * Time: 8:59 PM
 */

namespace Tim\UtilsBundle\Algorithms;

class TreeNode
{
    public $info;
    public $left;
    public $right;
    public $level;

    public function __construct($info)
    {
        $this->info = $info;
        $this->left = null;
        $this->right = null;
        $this->level = null;
    }

    public function __toString()
    {
        return "$this->info";
    }
}