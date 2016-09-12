<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 9/12/2016
 * Time: 9:07 PM
 */

namespace Tim\UtilsBundle\Utils;

class DateTimeUtils
{
    protected function currentDate()
    {
        // Use date() or DateTime object
        $result = date('r'); // Fri, 09 Feb 2016 15:34:00 -0500

        $date = new \DateTime();
        $result = $date->format('r'); // Fri, 09 Feb 2016 15:34:00 -0500

        // Use getdate() or localtime() if you want time parts
        $now_1 = getdate();
        $now_2 = localtime();
        $result = "{$now_1['hours']}:{$now_1['minutes']}:{$now_1['seconds']}\n"; // 21:25:32
        $result = "$now_2[2]:$now_2[1]:$now_2[0]"; // 21:25:32
        // printf('%s %d, %d',$a['month'],$a['mday'],$a['year']); // March 10, 2016
    }
}