<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 7/19/2016
 * Time: 9:11 PM
 */

namespace Tim\UtilsBundle\Tests;

use Tim\UtilsBundle\Algorithms\BinarySearchTree;
use Tim\UtilsBundle\Algorithms\TreeNode;

class BinarySearchTreeTest extends \PHPUnit_Framework_TestCase
{
    public function testBinarySearchTree()
    {
        $countItems = 100;
        $tree = new BinarySearchTree();

        for ($i = 0; $i <= $countItems; $i++) {
            $tree->create($i);
        }
        static::assertEquals($countItems, $tree->getItems());

        $item = $tree->search($countItems - 50);
        static::assertNotNull($item);

        $item = $tree->search($countItems + 25);
        static::assertNull($item);

        $min = $tree->min();
        static::assertInstanceOf(TreeNode::class, $min);
        static::assertEquals(0, $min->info);

        $max = $tree->max();
        static::assertInstanceOf(TreeNode::class, $max);
        static::assertEquals(100, $max->info);
    }
}