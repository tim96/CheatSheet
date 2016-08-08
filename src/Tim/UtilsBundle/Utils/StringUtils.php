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
    // Finding a substring:
    public function findSubstring()
    {
        if (strpos($_POST['email'], '@') === false) {
            print 'There was no @ in the e-mail address!';
        }
    }

    // Extracting substring:

}