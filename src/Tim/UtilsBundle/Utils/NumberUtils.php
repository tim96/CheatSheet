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

    protected function compareFloatValues()
    {
        // Absolute value
        // number abs ( mixed $number )
        // Returns the absolute value of number.

//        $result = abs(-4.2); // 4.2 (double/float)
//        $result = abs(5);    // 5 (integer)
//        $result = abs(-5);   // 5 (integer)

        $delta = 0.00001;
        $a = 1.00000001;
        $b = 1.00000000;
        if (abs($a - $b) < $delta) {
            $result = '$a and $b are equal enough.';
        }

        // Floating-point numbers are represented in binary form with only a finite number of
        // bits for the mantissa and the exponent. You get overflows when you exceed those bits.
        // As a result, sometimes PHP (just like some other languages) doesn’t believe that two
        // equal numbers are actually equal because they may differ toward the very end

        // To avoid this problem, instead of checking if $a == $b, make sure the first number is
        // within a very small amount ($delta) of the second one. The size of your delta should
        // be the smallest amount of difference you care about between two numbers. Then use
        // abs() to get the absolute value of the difference
    }

    protected function roundNumbers()
    {
        // round — Rounds a float
        // float round ( float $val [, int $precision = 0 [, int $mode = PHP_ROUND_HALF_UP ]] )
        // Returns the rounded value of val to specified precision (number of digits after the decimal point). precision can also be negative or zero (default).
        // Note: PHP doesn't handle strings like "12,300.2" correctly by default. See converting from strings.

        $result = round(3.4);         // 3
        $result = round(3.5);         // 4
        $result = round(3.6);         // 4
        $result = round(3.6, 0);      // 4
        $result = round(1.95583, 2);  // 1.96
        $result = round(1241757, -3); // 1242000
        $result = round(5.045, 2);    // 5.05
        $result = round(5.055, 2);    // 5.06

        // ceil — Round fractions up
        // float ceil ( float $value )
        // Returns the next highest integer value by rounding up value if necessary.

        $result = ceil(4.3);    // 5
        $result = ceil(9.999);  // 10
        $result = ceil(-3.14);  // -3

        // floor — Round fractions down
        // mixed floor ( float $value )
        // Returns the next lowest integer value (as float) by rounding down value if necessary.
        // value rounded to the next lowest integer. The return value of floor() is still of type float because the
        // value range of float is usually bigger than that of integer. This function returns FALSE in case of
        // an error (e.g. passing an array).

        $result = floor(4.3);   // 4
        $result = floor(9.999); // 9
        $result = floor(-3.14); // -4
    }
}