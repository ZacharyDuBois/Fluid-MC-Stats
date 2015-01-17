<?php
/**
 * Copyright (c) AccountProductions and Sybren Gjaltema, 2014. All rights reserved.
 */

function getPlayerList($mysqli, $mysql_table_prefix, $stat, $order, $page) {
  if ($stat == "online") {
    $stat_query = "greatest(ifnull(lastjoin,0), ifnull(lastleave,0))";
  } elseif ($stat == "id") {
    $stat_query = "player_id";
  } else {
    $stat_query = getDatabaseColumnNameFromPlayerStat($stat);
  }
  $query = "SELECT * FROM " . $mysql_table_prefix . "player GROUP BY player_id ORDER BY " . $stat_query . " " . $order . " LIMIT 15 OFFSET " . ((mysqli_real_escape_string($mysqli, $page) - 1) * 15);
  $result = $mysqli->query($query);

  return $result;
}
