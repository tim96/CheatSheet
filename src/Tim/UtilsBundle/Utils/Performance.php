<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 6/26/2016
 * Time: 1:19 PM
 */

namespace Tim\UtilsBundle\Utils;

class Performance
{
    public static function start()
    {
        return microtime(true);
    }

    public static function current()
    {
        return microtime(true);
    }

    public static function result($timeStart)
    {
        return microtime(true) - $timeStart;
    }

    public static function getMemoryUsage()
    {
        // echo "Memory Usage: " . (memory_get_usage()/1048576) . " MB \n";
        return memory_get_usage();
    }

    public static function getPeakMemoryUsage()
    {
        return memory_get_peak_usage();
    }

    public static function getMemoryLimit()
    {
        return ini_get('memory_limit');
    }

    public static function setMemoryLimit($limit)
    {
        ini_set('memory_limit', $limit);
    }

    public static function convertMemory($size)
    {
        $unit = array('b','kb','mb','gb','tb','pb');
        return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
    }

    public static function getMemoryUsageFormatted()
    {
        return self::convertMemory(memory_get_usage());
    }

    public static function getPeakMemoryUsageFormatted()
    {
        return self::convertMemory(memory_get_peak_usage());
    }
}