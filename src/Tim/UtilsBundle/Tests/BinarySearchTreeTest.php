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

        static::assertEquals(true, $tree->isEmpty());
        for ($i = 0; $i < $countItems; $i++) {
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

        $min = $tree->minValue();
        static::assertInstanceOf(TreeNode::class, $min);
        static::assertEquals(0, $min->info);

        $max = $tree->max();
        static::assertInstanceOf(TreeNode::class, $max);
        static::assertEquals($countItems - 1, $max->info);

        $max = $tree->maxValue();
        static::assertInstanceOf(TreeNode::class, $max);
        static::assertEquals($countItems - 1, $max->info);

        static::assertEquals(false, $tree->isEmpty());

        $node = $tree->delete($countItems - 50);
        static::assertInternalType('boolean', $node);
        static::assertTrue($node);
        static::assertEquals($countItems - 1, $tree->getItems());

        $node = $tree->delete($countItems - 50);
        static::assertInternalType('boolean', $node);
        static::assertFalse($node);
        static::assertEquals($countItems - 1, $tree->getItems());

        $node = $tree->delete($countItems - 75);
        static::assertInternalType('boolean', $node);
        static::assertTrue($node);
        static::assertEquals($countItems - 2, $tree->getItems());

//        var_dump('');
//        var_dump('Balance');
//        $tree->balance();
//
//        $item = $tree->search($countItems - 50);
//        static::assertNotNull($item);
//
//        $item = $tree->search($countItems + 25);
//        static::assertNull($item);

        $arr = array(8,3,1,6,4,7,10,14,13);
        $tree = new BinarySearchTree();
        foreach ($arr as $ar) {
            $tree->create($ar);
        }
    }

    public function test2()
    {
        $tree = new BinarySearchTree(5);
        $tree->create(2);
        $tree->create(1);
        $tree->create(4);
        $tree->create(11);
        $tree->create(7);
        $tree->create(23);
        $tree->create(16);
        $tree->create(34);

        $result = '1 2 4 7 11 16 23 34';
        // var_dump($tree->getInOrder());
    }
}