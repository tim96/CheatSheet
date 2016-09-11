<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 9/11/2016
 * Time: 2:22 PM
 */

namespace Tim\UtilsBundle\Utils;

class NumberUtils
{
    protected function checkType()
    {
        // is_numeric — Finds whether a variable is a number or a numeric string
        // bool is_numeric ( mixed $var )
        // Finds whether the given variable is numeric. Numeric strings consist of optional sign, any number of digits,
        // optional decimal part and optional exponential part. Thus +0123.45e6 is a valid numeric value.
        // Hexadecimal (e.g. 0xf4c3b00c) and binary (e.g. 0b10100111001) notation is not allowed.

//        '42' is numeric
//        '1337' is numeric
//        '1337' is numeric
//        '1337' is numeric
//        '1337' is numeric
//        '1337' is numeric
//        'not numeric' is NOT numeric
//        'Array' is NOT numeric
//        '9.1' is numeric

        // Helpfully, is_numeric() properly parses decimal numbers, such as 5.1; however, numbers
        // with thousands separators, such as 5,100, cause is_numeric() to return false.
        // Use str_replace to strip the thousands separators from number

        // gettype — Get the type of a variable
        // string gettype ( mixed $var )
        // Returns the type of the PHP variable var. For type checking, use is_* functions.

        $data = array(1, 1., NULL, new \stdClass, 'foo');

        foreach ($data as $value) {
            $result = gettype($value) . "\n";
//            integer
//            double
//            NULL
//            object
//            string
        }

        // is_float
        // is_int
        // is_integer
        // is_long
        // is_real
        // is_scalar
    }
}