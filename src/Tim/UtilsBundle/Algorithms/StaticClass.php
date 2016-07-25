<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 7/25/2016
 * Time: 8:56 PM
 */

namespace Tim\UtilsBundle\Algorithms;

class StaticClass
{
    /**
     * Search using Recursive Binary Search
     *
     * @param mixed $key
     * @param array $array
     * @return int
     */
    public static function rank($key, $array)
    {
        return self::binarySearch($key, $array, 0, count($array) - 1);
    }

    protected static function binarySearch($key, $list, $left, $right)
    {
        if ($left > $right) { return -1; }

        // Most of the optimization techniques mentioned online recommend to replace
        // the expensive operation of dividing by 2 with its bitwise equivalent (n >> 1) == n/2.
        // $mid = (int)(($left + $right) / 2);
        $mid = ($left + $right) >> 1;

        if ($list[$mid] === $key) {
            return $mid;
        } elseif ($list[$mid] > $key) {
            return self::binarySearch($key, $list, $left, $mid-1);
        } elseif ($list[$mid] < $key) {
            return self::binarySearch($key, $list, $mid+1, $right);
        }
    }

    /**
     * Search using Iterative  Binary Search
     *
     * @param mixed $key
     * @param array $list
     *
     * @return int
     */
    public static function binarySearchIterative($key, $list)
    {
        $left = 0;
        $right = count($list) - 1;

        while ($left <= $right) {
            // Most of the optimization techniques mentioned online recommend to replace
            // the expensive operation of dividing by 2 with its bitwise equivalent (n >> 1) == n/2.
            // $mid = (int)(($left + $right) / 2);
            $mid = ($left + $right) >> 1;

            if ($list[$mid] === $key) {
                return $mid;
            } elseif ($list[$mid] > $key) {
                $right = $mid - 1;
            } elseif ($list[$mid] < $key) {
                $left = $mid + 1;
            }
        }

        return -1;
    }
}