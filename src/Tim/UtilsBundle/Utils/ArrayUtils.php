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

    public static function getFirstItemsFromArray(array $array, $countItems)
    {
        return array_slice($array, 0, $countItems);
    }
// If the array indices are meaningful to you, remember that array_slice will reset and reorder the numeric array indices.
// You need the preserve_keys flag set to trueto avoid this. (4th parameter, available since 5.0.2).
// return array_slice($array, 2, 3, true);

}