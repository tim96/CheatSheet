<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 8/5/2016
 * Time: 9:46 PM
 */

namespace Tim\UtilsBundle\Utils;

class ArrayUtils
{
    public static function diff(array $array1, array $array2)
    {
        return array_merge(array_diff($array1, $array2), array_diff($array2, $array1));
    }

    public static function array_equal_values(array $a, array $b)
    {
        return !array_diff($a, $b) && !array_diff($b, $a);
    }

    // Array equals
//  $arraysAreEqual = ($a == $b); // TRUE if $a and $b have the same key/value pairs.
//  $arraysAreEqual = ($a === $b); // TRUE if $a and $b have the same key/value pairs in the same order and of the same types.
}