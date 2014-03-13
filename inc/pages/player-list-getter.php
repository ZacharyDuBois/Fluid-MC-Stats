<?php

/**
 * Copyright (c) AccountProductions and Lolmewn 2014. All Rights Reserved.
 */

function getPlayerList($mysqli, $mysql_table_prefix, $page)
{
  $query = "SELECT * FROM " . $mysql_table_prefix . "player GROUP BY player_id ORDER BY greatest(ifnull(lastjoin,0), ifnull(lastleave,0)) DESC LIMIT 15 OFFSET " . ((mysqli_real_escape_string($mysqli, $page) - 1) * 15);
  $result = $mysqli->query($query);
  return $result;
}
