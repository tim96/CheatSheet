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

    protected function convertDateTime()
    {
        // Getting a specific epoch timestamp
        // 7:45:03 PM on March 10, 1975, local time
        // Assuming your "local time" is US Eastern time
        $then = mktime(19, 45, 3, 3, 10, 1975);

        // Getting a specific GMT-based epoch timestamp
        // 7:45:03 PM on March 10, 1975, in GMT
        $then = gmmktime(19, 45, 3, 3, 10, 1975);

        // Getting a specific epoch timestamp from a formatted time string
        // 7:45:03 PM on March 10, 1975, in a particular timezone
        $then = \DateTime::createFromFormat(\DateTime::ATOM, "1975-03-10T19:45:03-04:00");

        date_default_timezone_set('America/New_York');
        // $stamp_future is 1733257500
        $stamp_future = mktime(15,25,0,12,3,2024);

        // $formatted is '2024-12-03T15:25:00-05:00'
        $formatted = date('c', $stamp_future);
    }
}