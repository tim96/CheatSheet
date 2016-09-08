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

    // Replace a substring
    public function replaceSubstring()
    {
        // Everything from position $start to the end of $old_string
        // $new_string = substr_replace($old_string, $new_substring, $start);

        // $length characters, starting at position $start, become $new_substring
        // $new_string = substr_replace($old_string, $new_substring, $start, $length);

        $new_string = substr_replace('My pet is a blue dog.', 'fish.', 12);
        $new_string = substr_replace('My pet is a blue dog.', 'green', 12, 4);
        // My pet is a fish.
        // My pet is a green dog.

        // If $start is negative, the new substring is placed by counting $start characters from
        // the end of $old_string, not from the beginning:
        $new_string = substr_replace('My pet is a blue dog.','fish.', -9);
        $new_string = substr_replace('My pet is a blue dog.','green', -9, 4);
        // My pet is a fish.
        // My pet is a green dog.

        // If $start and $length are 0, the new substring is inserted at the start of $old_string:
        $new_string = substr_replace('My pet is a blue dog.','Title: ',0,0);
        // Title: My pet is a blue dog

        // Displaying long text with an ellipsis
        // printf('<a href="more-text.php?id=%d">%s</a>', $ob->id, substr_replace($ob->message, ' ...', 25));
    }

    
}