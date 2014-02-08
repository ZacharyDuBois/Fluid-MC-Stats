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

function getTopPlayers($mysqli, $dbPrefix, $stat, $page) {
    $query;
    switch ($stat) {
        case "broken":
        case "placed":
            $query = "SELECT player_id,SUM(amount) AS value FROM " . $dbPrefix . "block WHERE "
                . "break=" . $stat == "broken" ? "1" : "0"
                . (usesSnapshots($mysqli, $dbPrefix) ? " AND snapshot_name='main_snapshot'" : "") 
                . " GROUP BY player_id ORDER BY SUM(amount) DESC LIMIT 15 OFFSET " . (($page - 1) * 15);
            break;
        case "kill":
            $query = "SELECT player_id,SUM(amount) AS value FROM " . $dbPrefix . "kill "
                . (usesSnapshots($mysqli, $dbPrefix) ? " WHERE snapshot_name='main_snapshot'" : "") 
                . " GROUP BY player_id ORDER BY SUM(amount) DESC LIMIT 15 OFFSET " . (($page - 1) * 15);
            break;
        case "death":
            $query = "SELECT player_id,SUM(amount) AS value FROM " . $dbPrefix . "death "
                . (usesSnapshots($mysqli, $dbPrefix) ? " WHERE snapshot_name='main_snapshot'" : "") 
                . " GROUP BY player_id ORDER BY SUM(amount) DESC LIMIT 15 OFFSET " . (($page - 1) * 15);
            break;
        case "move":
            $query = "SELECT player_id,SUM(distance) AS value FROM " . $dbPrefix . "move "
                . (usesSnapshots($mysqli, $dbPrefix) ? " WHERE snapshot_name='main_snapshot'" : "") 
                . " GROUP BY player_id ORDER BY SUM(distance) DESC LIMIT 15 OFFSET " . (($page - 1) * 15);
            break;
        default:
            $query = "SELECT player_id,SUM(" . getDatabaseColumnNameFromPlayerStat($stat) . ") AS value FROM " . $dbPrefix . "player "
                . (usesSnapshots($mysqli, $dbPrefix) ? " WHERE snapshot_name='main_snapshot'" : "") 
                . " GROUP BY player_id ORDER BY SUM(" . getDatabaseColumnNameFromPlayerStat($stat) . ") DESC LIMIT 15 OFFSET " . (($page - 1) * 15);
    }
    $result = $mysqli->query($query);
    var_dump($query);
    return $result;
}

/**
 * This function converts a stat from the player table to the column name where that stat is stored
 * @param type $stat Stat to look up
 */
function getDatabaseColumnNameFromPlayerStat($stat){
    switch($stat){
        case "arrows":
        case "toolsbroken":
        case "votes":
        case "playtime":
            return $stat; //exact same
        case "exp":
            return "xpgained";
        case "fish":
            return "fishcatch";
        case "damage":
            return "damagetaken";
        case "consumed":
            return "omnomnom";
        case "crafted":
            return "itemscrafted";
        case "eggs":
            return "eggsthrown";
        case "commands":
            return "commandsdone";
        case "dropped":
            return "itemdrops";
        case "pickedup":
            return "itempickups";
        case "teleport":
            return "teleports";
        default:
            return "playtime"; //we can't find it, default to most safe value
    }
}

function usesSnapshots($mysqli, $dbPrefix) {
    $result = $mysqli->query("SHOW COLUMNS FROM " . $dbPrefix . "player LIKE 'snapshot_name'");
    return (mysqli_num_rows($result)) ? TRUE : FALSE;
}
