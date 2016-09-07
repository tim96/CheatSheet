<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 8/8/2016
 * Time: 9:45 PM
 */

namespace Tim\UtilsBundle\Utils;

class StringUtils
{
    // Double-quoted string escape sequences:
    //
    // \n - Newline (ASCII 10)
    // \r - Carriage return (ASCII 13)
    // \t - Tab (ASCII 9)
    // \v - Vertical Tab (ASCII 11)
    // \e - escape (ASCII 27)
    // \f - escape (ASCII 12)
    // \\ - Backslash
    // \$ - Dollar sign
    // \" - Double quote
    // \[0-7]{1,3} - the sequence of characters matching the regular expression is a character in octal notation, which
    // silently overflows to fit in a byte (e.g. "\400" === "\000")
    // \x[0-9A-Fa-f]{1,2} - the sequence of characters matching the regular expression is a character in
    // hexadecimal notation
    //
    // \u{[0-9A-Fa-f]+} - the sequence of characters matching the regular expression is a Unicode codepoint, which
    // will be output to the string as that codepoint's UTF-8 representation (added in PHP 7.0.0)

    // Finding a substring:
    public function findSubstring()
    {
        if (strpos($_POST['email'], '@') === false) {
            print 'There was no @ in the e-mail address!';
        }
    }

    // Extracting substring:
    public function extractSubstring()
    {
        // If $start and $length are positive, substr() returns $length characters in the string, starting at $start.
        // If you leave out $length, substr() returns the string from $start to the end of the original string
        // If $start is bigger than the length of the string, substr() returns false

        // $substring = substr($string, $start, $length);

        $username = substr($_GET['username'], 0, 8);
    }
}