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

        // Example how to replace tabs to spaces
        $message = 'Message with tabs';
        $tabbed = str_replace(' ' , "\t", $message);
        $spaced = str_replace("\t", ' ' , $message);
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


    protected function splitString()
    {
        // array str_split ( string $string [, int $split_length = 1 ] )
        // Converts a string to an array.
        // If the optional split_length parameter is specified, the returned array will be broken down into chunks
        // with each being split_length in length, otherwise each chunk will be one character in length.

        $str = 'Hello Friend';

        $result = str_split($str);
        $result = str_split($str, 3);
//        Array
//        (
//            [0] => H
//            [1] => e
//            [2] => l
//            [3] => l
//            [4] => o
//            [5] =>
//            [6] => F
//            [7] => r
//            [8] => i
//            [9] => e
//            [10] => n
//            [11] => d
//        )
//
//        Array
//        (
//            [0] => Hel
//            [1] => lo
//            [2] => Fri
//            [3] => end
//        )
    }

    // Example how to capitalize, lowercase, or otherwise modify the case of letters in a string
    protected function workWithLettersInString()
    {
        // string ucfirst ( string $str )
        // Returns a string with the first character of str capitalized, if that character is alphabetic.

        // string ucwords ( string $str [, string $delimiters = " \t\r\n\f\v" ] )
        // Returns a string with the first character of each word in str capitalized, if that character is alphabetic.

        $result = ucfirst('how do you do today?'); // How do you do today?
        $result = ucwords('the prince of wales'); // The Prince Of Wales

        // string strtolower ( string $string )
        // Returns string with all alphabetic characters converted to lowercase.

        // string strtoupper ( string $string )
        // Returns string with all alphabetic characters converted to uppercase.
        $result = strtoupper("i'm not yelling!"); // I'M NOT YELLING!
        $result = strtolower('<A HREF="one.php">one</A>'); // <a href="one.php">one</a>
    }

    protected function trimString()
    {
        // string trim ( string $str [, string $character_mask = " \t\n\r\0\x0B" ] )
        // This function returns a string with whitespace stripped from the beginning and end of str.

        // string ltrim ( string $str [, string $character_mask ] )
        // Strip whitespace (or other characters) from the beginning of a string.

        // string rtrim ( string $str [, string $character_mask ] )
        // This function returns a string with whitespace (or other characters) stripped from the end of str.

        $text = "\t\tThese are a few words :) ...  ";
        $result = trim($text);
        // "These are a few words :) ..."

        // The trim() functions can also remove user-specified characters from strings. Pass the
        // characters you want to remove as a second argument.
        $result = ltrim('10 PRINT A$', '0..9'); // PRINT A$
        $result = rtrim('SELECT * FROM turtles;', ';'); // SELECT * FROM turtles
    }

    protected function workWithCSV()
    {
        // int fputcsv ( resource $handle , array $fields [, string $delimiter = "," [, string $enclosure = '"' [, string $escape_char = "\" ]]] )
        // fputcsv — Format line as CSV and write to file pointer
        // fputcsv() formats a line (passed as a fields array) as CSV and write it (terminated by a newline) to the specified file handle.
        // Returns the length of the written string or FALSE on failure.

        $list = array (
            array('aaa', 'bbb', 'ccc', 'dddd'),
            array('123', '456', '789'),
            array('"aaa"', '"bbb"')
        );

        $filename = 'file.csv';
        // To print the CSV-formatted data instead of writing it to a file, use the special output stream php://output
        // $filename = fopen('php://output','w');
        // ob_start();

        $fp = fopen($filename, 'w') or die("Can't open $filename");

        foreach ($list as $fields) {
            if (fputcsv($fp, $fields) === false) {
                die("Can't write CSV line");
            }
        }

        fclose($fp) or die("Can't close $filename");

        // $output = ob_get_contents();
        // ob_end_clean();
    }

    protected function readFromCSV()
    {
        // array fgetcsv ( resource $handle [, int $length = 0 [, string $delimiter = "," [, string $enclosure = '"' [, string $escape = "\" ]]]] )
        // Similar to fgets() except that fgetcsv() parses the line it reads for fields in CSV format and returns an array containing the fields read.
        // fgetcsv — Gets line from file pointer and parse for CSV fields
        // Returns an indexed array containing the fields read.
        // fgetcsv() returns NULL if an invalid handle is supplied or FALSE on other errors, including end of file.

        $filename = 'file.csv';
        $fp = fopen($filename,'r') or die("Can't open $filename");
        print "<table>\n";
        while(($csv_line = fgetcsv($fp)) !== false) {
            print '<tr>';
            for ($i = 0, $j = count($csv_line); $i < $j; $i++) {
                print '<td>'.htmlentities($csv_line[$i]).'</td>';
            }
            print "</tr>\n";
        }
        print "</table>\n";
        fclose($fp) or die("Can't close $filename");
    }

    // Example how to pack data into binary format
    protected function packData()
    {
        // string pack ( string $format [, mixed $args [, mixed $... ]] )
        // Pack given arguments into a binary string according to format.
        // Returns a binary string containing data.

        $books = array( array('Elmer Gantry', 'Sinclair Lewis', 1927),
            array('The Scarlatti Inheritance','Robert Ludlum', 1971),
            array('The Parsifal Mosaic','William Styron', 1979) );

        // The format string A25A14A4 tells pack() to transform its subsequent arguments into a
        // 25-character space-padded string, a 14-character space-padded string, and a 4-
        // character space-padded string.
        foreach ($books as $book) {
            $result = pack('A25A15A4', $book[0], $book[1], $book[2]) . "\n";
        }

        $result = pack("nvc*", 0x1234, 0x5678, 65, 66);
        // The resulting binary string will be 6 bytes long and contain the byte sequence 0x12, 0x34, 0x78, 0x56, 0x41, 0x42.
    }

    protected function paddingString()
    {
        // Pad a string to a certain length with another string
        // string str_pad ( string $input , int $pad_length [, string $pad_string = " " [, int $pad_type = STR_PAD_RIGHT ]] )
        // This functions returns the input string padded on the left, the right, or both sides to the specified padding
        // length. If the optional argument pad_string is not supplied, the input is padded with spaces, otherwise
        // it is padded with characters from pad_string up to the limit.

        $input = 'Alien';
        $result = str_pad($input, 10);                      // produces "Alien     "
        $result = str_pad($input, 10, "-=", STR_PAD_LEFT);  // produces "-=-=-Alien"
        $result = str_pad($input, 10, "_", STR_PAD_BOTH);   // produces "__Alien___"
        $result = str_pad($input,  6, "___");               // produces "Alien_"
        $result = str_pad($input,  3, "*");                 // produces "Alien"

        // use substr() to ensure that the field values aren’t too long and str_pad() to ensure that the field values aren’t too short.
        // into fixed-width record with .-padded fields.
        $title = str_pad(substr($input, 0, 25), 25, '.');
    }

    // Example how to unpack data into binary format
    protected function unpackData()
    {
        // array unpack ( string $format , string $data )
        // Unpacks from a binary string into an array according to the given format.
        // Returns an associative array containing unpacked elements of binary string.

        $result = array();
        $data = 'data';
        $formatString = 'format_string';
        for ($i = 0, $j = count($data); $i < $j; $i++) {
            $result[$i] = unpack($formatString, $data[$i]);
        }

        $binarydata = "\x04\x00\xa0\x00";
        $result = unpack("cchars/nint", $binarydata);
//        (
//            [chars] => 4
//            [int] => 160
//        )

        $binarydata = "\x04\x00\xa0\x00";
        $result = unpack("c2chars/nint", $binarydata);
//        (
//            [chars1] => 4
//            [chars2] => 0
//            [int] => 40960
//        )
    }

    protected function pregSplitExample()
    {
        // Split string by a regular expression
        // array preg_split ( string $pattern , string $subject [, int $limit = -1 [, int $flags = 0 ]] )
        // Returns an array containing substrings of subject split along boundaries matched by pattern, or FALSE on failure.

        // split the phrase by any number of commas or space characters,
        // which include " ", \r, \t, \n and \f
        $result = preg_split("/[\s,]+/", "hypertext language, programming");
//        Array
//        (
//            [0] => hypertext
//            [1] => language
//            [2] => programming
//        )

        // With preg_split(), you have more flexibility. Instead of a string literal as a separator,
        // it uses a Perl-compatible regular expression engine.
        $math = "3 + 2 / 7 - 9";
        $result = preg_split('/ *([+\-\/*]) */', $math, -1, PREG_SPLIT_DELIM_CAPTURE);
//        Array
//        (
//            [0] => 3
//            [1] => +
//            [2] => 2
//            [3] => /
//            [4] => 7
//            [5] => -
//            [6] => 9
//        )
    }

    // Wraps a string to a given number of characters
    // string wordwrap ( string $str [, int $width = 75 [, string $break = "\n" [, bool $cut = false ]]] )
    // Wraps a string to a given number of characters using a string break character.
    // $text = "The quick brown fox jumped over the lazy dog.";
    // $newtext = wordwrap($text, 20, "<br />\n");

    protected function downloadCSV()
    {
        $sales_data = array();

        // Open filehandle for fputcsv()
        $output = fopen('php://output','w') or die("Can't open php://output");
        $total = 0;

        // Tell browser to expect a CSV file
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="sales.csv"');

        // Print header row
        fputcsv($output,array('Region','Start Date','End Date','Amount'));

        // Print each data row and increment $total
        foreach ($sales_data as $sales_line) {
            fputcsv($output, $sales_line);
            $total += $sales_line[3];
        }

        fputcsv($output,array('All Regions','--','--',$total));
        fclose($output) or die("Can't close php://output");
    }
}