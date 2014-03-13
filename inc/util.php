<?php

/**
 * Copyright (c) AccountProductions and Lolmewn 2014. All Rights Reserved.
 */

/**
 * Converts date to "3h ago" for example
 * @param type $date
 * @return string
 */
function nicetime($date)
{
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
    $periods[$j] .= "s";
  }

  return "$difference $periods[$j] {$tense}";
}

function shorten($string, $length)
{
  if (strlen($string) > $length) {
    return "<abbr title='" . $string . "'>" . substr($string, 0, $length - 3) . "...</abbr>";
  } else {
    return $string;
  }
}

function getTopPlayers($mysqli, $dbPrefix, $stat, $page)
{
  $query;
  switch ($stat) {
    case "broken":
    case "placed":
      $query = "SELECT player_id,SUM(amount) AS value FROM {$dbPrefix}block WHERE "
        . "break=" . ($stat == "broken" ? "1" : "0")
        . (usesSnapshots($mysqli, $dbPrefix) ? " AND snapshot_name='main_snapshot'" : "")
        . " GROUP BY player_id ORDER BY SUM(amount) DESC LIMIT 15 OFFSET " . (($page - 1) * 15);
      break;
    case "kill":
      $query = "SELECT player_id,SUM(amount) AS value FROM {$dbPrefix}kill "
        . (usesSnapshots($mysqli, $dbPrefix) ? " WHERE snapshot_name='main_snapshot'" : "")
        . " GROUP BY player_id ORDER BY SUM(amount) DESC LIMIT 15 OFFSET " . (($page - 1) * 15);
      break;
    case "death":
      $query = "SELECT player_id,SUM(amount) AS value FROM {$dbPrefix}death "
        . (usesSnapshots($mysqli, $dbPrefix) ? " WHERE snapshot_name='main_snapshot'" : "")
        . " GROUP BY player_id ORDER BY SUM(amount) DESC LIMIT 15 OFFSET " . (($page - 1) * 15);
      break;
    case "move":
      $query = "SELECT player_id,SUM(distance) AS value FROM {$dbPrefix}move "
        . (usesSnapshots($mysqli, $dbPrefix) ? " WHERE snapshot_name='main_snapshot'" : "")
        . " GROUP BY player_id ORDER BY SUM(distance) DESC LIMIT 15 OFFSET " . (($page - 1) * 15);
      break;
    default:
      $query = "SELECT player_id,SUM(" . getDatabaseColumnNameFromPlayerStat($stat) . ") AS value FROM {$dbPrefix}player "
        . (usesSnapshots($mysqli, $dbPrefix) ? " WHERE snapshot_name='main_snapshot'" : "")
        . " GROUP BY player_id ORDER BY SUM(" . getDatabaseColumnNameFromPlayerStat($stat) . ") DESC LIMIT 15 OFFSET " . (($page - 1) * 15);
  }
  $result = $mysqli->query($query);
  return $result;
}

function getPlayerStat($mysqli, $dbPrefix, $player_id, $stat)
{
  $query;
  switch ($stat) {
    case "broken":
    case "placed":
      $query = "SELECT SUM(amount) AS value FROM {$dbPrefix}block WHERE "
        . "break=" . ($stat == "broken" ? "1" : "0")
        . " AND player_id=" . $player_id
        . (usesSnapshots($mysqli, $dbPrefix) ? " AND snapshot_name='main_snapshot'" : "");
      break;
    case "kill":
      $query = "SELECT SUM(amount) AS value FROM {$dbPrefix}kill "
        . " WHERE player_id=" . $player_id
        . (usesSnapshots($mysqli, $dbPrefix) ? " AND snapshot_name='main_snapshot'" : "");
      break;
    case "death":
      $query = "SELECT SUM(amount) AS value FROM {$dbPrefix}death "
        . " WHERE player_id=" . $player_id
        . (usesSnapshots($mysqli, $dbPrefix) ? " AND snapshot_name='main_snapshot'" : "");
      break;
    case "move":
      $query = "SELECT SUM(distance) AS value FROM {$dbPrefix}move "
        . " WHERE player_id=" . $player_id
        . (usesSnapshots($mysqli, $dbPrefix) ? " AND snapshot_name='main_snapshot'" : "");
      break;
    case "lastjoin":
    case "lastleave":
      $query = "SELECT UNIX_TIMESTAMP({$stat}) AS value FROM {$dbPrefix}player "
        . " WHERE player_id=" . $player_id
        . (usesSnapshots($mysqli, $dbPrefix) ? " AND snapshot_name='main_snapshot'" : "");
      break;
    default:
      $query = "SELECT SUM(" . getDatabaseColumnNameFromPlayerStat($stat) . ") AS value FROM {$dbPrefix}player "
        . " WHERE player_id=" . $player_id
        . (usesSnapshots($mysqli, $dbPrefix) ? " AND snapshot_name='main_snapshot'" : "");
  }
  $result = $mysqli->query($query);
  $arr = $result->fetch_array();
  return $arr['value'];
}

function getServerTotal($mysqli, $dbPrefix, $stat)
{
  $query;
  switch ($stat) {
    case "broken":
    case "placed":
      $query = "SELECT SUM(amount) AS value FROM {$dbPrefix}block WHERE "
        . "break=" . ($stat == "broken" ? "1" : "0")
        . (usesSnapshots($mysqli, $dbPrefix) ? " AND snapshot_name='main_snapshot'" : "");
      break;
    case "kill":
      $query = "SELECT SUM(amount) AS value FROM {$dbPrefix}kill "
        . (usesSnapshots($mysqli, $dbPrefix) ? " WHERE snapshot_name='main_snapshot'" : "");
      break;
    case "death":
      $query = "SELECT SUM(amount) AS value FROM {$dbPrefix}death "
        . (usesSnapshots($mysqli, $dbPrefix) ? " WHERE snapshot_name='main_snapshot'" : "");
      break;
    case "move":
      $query = "SELECT SUM(distance) AS value FROM {$dbPrefix}move "
        . (usesSnapshots($mysqli, $dbPrefix) ? " WHERE snapshot_name='main_snapshot'" : "");
      break;
    default:
      $query = "SELECT SUM(" . getDatabaseColumnNameFromPlayerStat($stat) . ") AS value FROM {$dbPrefix}player "
        . (usesSnapshots($mysqli, $dbPrefix) ? " WHERE snapshot_name='main_snapshot'" : "");
  }
  $result = $mysqli->query($query);
  if (!$result) {
    return $mysqli->error;
  }
  $arr = $result->fetch_array();
  return $arr['value'];
}

function getServerAverage($mysqli, $dbPrefix, $stat, $playtimeLimiter)
{
  $amountOfPlayers = getAmountOfPlayers($mysqli, $dbPrefix, $playtimeLimiter);
  $serverTotal = getServerTotal($mysqli, $dbPrefix, $stat);
  return $serverTotal / $amountOfPlayers;
}

function getAmountOfPlayers($mysqli, $dbPrefix, $playtimeLimiter)
{
  $query = "SELECT COUNT(DISTINCT player_id) AS value FROM {$dbPrefix}player WHERE playtime>={$playtimeLimiter}";
  $result = $mysqli->query($query);
  $arr = $result->fetch_array();
  return $arr['value'];
}

/**
 * This function converts a stat from the player table to the column name where that stat is stored
 * @param type $stat Stat to look up
 */
function getDatabaseColumnNameFromPlayerStat($stat)
{
  if ($stat == "") {
    return "playtime"; //probably misconfigured, go for the safest option.
  }
  switch ($stat) {
    case "exp":
      return "xpgained";
    case "fish":
      return "fishcatched";
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
      return $stat;
  }
}

function usesSnapshots($mysqli, $dbPrefix)
{
  $result = $mysqli->query("SHOW COLUMNS FROM {$dbPrefix}player LIKE 'snapshot_name'");
  return (mysqli_num_rows($result)) ? TRUE : FALSE;
}

function capitalise($sentence)
{
  return ucfirst(strtolower($sentence));
}

function getHumanFriendlyStatName($stat)
{
  switch ($stat) {
    case "broken":
      return "Blocks broken";
    case "placed":
      return "Blocks placed";
    case "arrows":
      return "Arrows shot";
    case "exp":
      return "Experience gained";
    case "fish":
      return "Fish cought";
    case "damage":
      return "Damage taken";
    case "consumed":
      return "Food consumed";
    case "crafted":
      return "Items crafted";
    case "eggs":
      return "Eggs thrown";
    case "toolsbroken":
      return "Tools broken";
    case "commands":
      return "Commands performed";
    case "votes":
      return "Amount of times voted";
    case "dropped":
      return "Items dropped";
    case "pickedup":
      return "Items picked up";
    case "teleport":
      return "Teleports";
    default:
      return capitalise($stat);
  }
}

function translateValue($stat, $value)
{
  switch ($stat) {
    case "playtime":
      return convert_playtime($value);
  }
  return $value;
}

function convert_playtime($pt)
{
  $days = floor($pt / 86400);
  $hours = floor(($pt - $days * 86400) / 3600);
  $mins = floor(($pt - $hours * 3600 - $days * 86400) / 60);
  $secs = floor($pt - $hours * 3600 - $days * 86400 - $mins * 60);
  return $days . 'd:' . $hours . 'h:' . $mins . 'm:' . $secs . 's';
}

function findPlayer($mysqli, $dbPrefix, $player, $page = 1)
{
  $query = "SELECT player_id,name FROM {$dbPrefix}players WHERE name LIKE ? LIMIT 15 OFFSET " . (($page - 1) * 15);
  $ps;
  if (!($ps = $mysqli->prepare($query))) {
    die("Couldn't prepare statement: " . $mysqli->error);
  }
  $player = '%' . $player . '%';
  $ps->bind_param("s", $player);
  $ps->execute();
  $array = array();
  $player_id = NULL;
  $name = NULL;
  $ps->bind_result($player_id, $name);
  while ($ps->fetch()) {
    $array[] = array("player_id" => $player_id, "name" => $name);
  }
  $ps->close();
  return $array;
}

function findPlayerAmount($mysqli, $dbPrefix, $player)
{
  $query = "SELECT COUNT(*) FROM {$dbPrefix}players " . ($player != NULL ? "WHERE name LIKE ?" : "");
  $ps = $mysqli->prepare($query);
  $player = '%' . $player . '%';
  $ps->bind_param("s", $player);
  $ps->execute();
  $value = NULL;
  $ps->bind_result($value);
  $ps->fetch();
  $ps->close();
  return $value;
}
