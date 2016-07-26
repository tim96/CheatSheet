<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 7/19/2016
 * Time: 9:11 PM
 */

namespace Tim\UtilsBundle\Tests;

use Tim\UtilsBundle\Algorithms\StaticClass;

class StaticClassTest extends \PHPUnit_Framework_TestCase
{
    public function testRank()
    {
        $arr = array(8,3,1,6,4,7,10,14,13);
        if (sort($arr)) {
            $result = StaticClass::rank(6, $arr);
            self::assertEquals(3, $result);
        }
    }

    public function testRank1()
    {
        $list = array(0, 1, 1, 2, 3, 5, 8, 13, 21, 34, 55, 89, 144);
        $x = 55;

        $result = StaticClass::rank($x, $list);
        self::assertEquals(10, $result);
    }

    public function testRankIterative()
    {
        $arr = array(8,3,1,6,4,7,10,14,13);
        if (sort($arr)) {
            $result = StaticClass::binarySearchIterative(6, $arr);
            self::assertEquals(3, $result);
        }
    }

    public function testRankIteative1()
    {
        $list = array(0, 1, 1, 2, 3, 5, 8, 13, 21, 34, 55, 89, 144);
        $x = 55;

        $result = StaticClass::binarySearchIterative($x, $list);
        self::assertEquals(10, $result);
    }

//    public function testPerformance()
//    {
//        $arr = array();
//        for($i = 0; $i < 3000000; $i++) {
//            $arr[$i] = $i;
//        }
//        $value = 99999;
//
//        $msc = microtime(true);
//        $pos = in_array($value, $arr);
//        $msc = microtime(true) - $msc;
//
//        echo 'Time in_array: ' . round($msc * 1000, 3) . ' ms \r\n ';
//        self::assertEquals(1, (int)$pos);
//
//        $msc = microtime(true);
//        $pos = StaticClass::binarySearchIterative($value, $arr);
//        $msc = microtime(true) - $msc;
//
//        echo 'Time binarySearchIterative: ' . round($msc * 1000, 3) . ' ms \r\n ';
//        self::assertEquals(true, (bool)$pos);
//    }
}