<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 8/5/2016
 * Time: 9:11 PM
 */

namespace Tim\UtilsBundle\Utils;

class Rand
{
    public static function generate($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}