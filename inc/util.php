<?php

/**
* Copyright (c) AccountProductions and Lolmewn 2014. All Rights Reserved.
*/

/**
 * Converts date to "3h ago" for example
 * @param type $date
 * @return string
 */
function nicetime($date) {
    if (empty($date)) {
        return "No date provided";
    }
    date_default_timezone_set("Europe/Amsterdam");
    $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths = array("60", "60", "24", "7", "4.35", "12", "10");

    $now = time();
    $unix_date = strtotime($date);

// check validity of date
    if (empty($unix_date)) {
        return "Bad date";
    }

// is it future date or past date
    if ($now > $unix_date) {
        $difference = $now - $unix_date;
        $tense = "ago";
    } else {
        $difference = $unix_date - $now;
        $tense = "from now";
    }

    for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
        $difference /= $lengths[$j];
    }

    $difference = round($difference);

    if ($difference != 1) {
        $periods[$j].= "s";
    }

    return "$difference $periods[$j] {$tense}";
}

function shorten($string, $length) {
    if (strlen($string) > $length) {
        return "<abbr title='" . $string . "'>" . substr($string, 0, $length - 3) . "...</abbr>";
    } else {
        return $string;
    }
}