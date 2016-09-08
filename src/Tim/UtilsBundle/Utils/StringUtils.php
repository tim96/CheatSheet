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

    // Process each byte in a string individually
    protected function processingStringOneByte()
    {
        $string = "This weekend, I'm going shopping for a pet chicken.";
        for ($i = 0, $j = strlen($string); $i < $j; $i++) {
            $byte = $string[$i];
        }
    }

    // Find the first occurrence of a string
    protected function searchFirstOccurence()
    {
        // string strstr( string $haystack , mixed $needle [, bool $before_needle = false ] )
        // Returns part of haystack string starting from and including the first occurrence of needle to the end of haystack.
        // This function is case-sensitive.
        // Returns the portion of string, or FALSE if needle is not found.

        $email  = 'name@example.com';
        $domain = strstr($email, '@');
        // result - @example.com

        $user = strstr($email, '@', true); // As of PHP 5.3.0
        // result - name

        // string stristr( string $haystack , mixed $needle [, bool $before_needle = false ] )
        // Returns all of haystack starting from and including the first occurrence of needle to the end.
        // This function case-insensitive.
        // Returns the matched substring. If needle is not found, returns FALSE.

        $email = 'USER@EXAMPLE.com';
        $result = stristr($email, 'e'); // outputs ER@EXAMPLE.com
        $result = stristr($email, 'e', true); // As of PHP 5.3.0, outputs US
    }

    // Reverse the words or the bytes in a string
    protected function reverseTheWords()
    {
        // string strrev( string $string )
        // Returns string, reversed.

        $result = strrev('Hello world!');
        // result - "!dlrow olleH"
    }

    protected function convertStringToArray()
    {
        // array explode( string $delimiter , string $string [, int $limit = PHP_INT_MAX ] )
        // Returns an array of strings, each of which is a substring of string formed by splitting
        // it on boundaries formed by the string delimiter.

        $string = 'Hello world';
        $words = explode(' ', $string);
        // result - array('0' => 'Hello', '1' => 'world');

        $str = 'one|two|three|four';
        $words = explode('|', $str, 2);
        // result - array('0' => 'one', '1' => 'two|three|four');

        $words = explode('|', $str, -1);
        // result - array('0' => 'one', '1' => 'two', '2' => 'three');
    }

    protected function convertArrayToString()
    {
        // string implode( string $glue , array $pieces )
        // Join array elements with a glue string.
        // Returns a string containing a string representation of all the array elements in the same order,
        // with the glue string between each element.

        $array = array('lastname', 'email', 'phone');
        $string = implode(',', $array);
        // result - 'lastname,email,phone';

        $string = implode('hello', array());
        // result - '';
    }

    // Example how to generate random string
    protected function generateRandomString()
    {
        // int mt_rand( void )
        // mt_rand — Generate a better random value
        // A random integer value between min (or 0) and max (or mt_getrandmax(), inclusive), or FALSE if max is less than min.

        $length = 32;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        if (!is_int($length) || $length < 0) {
            return false;
        }

        $characters_length = strlen($characters) - 1;
        $string = '';

        for ($i = $length; $i > 0; $i--) {
            $string .= $characters[mt_rand(0, $characters_length)];
        }

        return $string;
    }
}