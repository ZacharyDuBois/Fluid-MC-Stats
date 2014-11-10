<?php
/**
 * Copyright (c) AccountProductions and Sybren Gjaltema, 2014. All rights reserved.
 */

header('Content-Type: application/json');

include '../../config.php';
include '../db.php';
include '../util.php';
include '../pages/player-list-getter.php';
include '../queries.php';

$players = getPlayerList($mysqli, $mysql_table_prefix, 1);
if (!$players || empty($players)) {
  die(json_encode("Query failed, or no players are found"));
}

$arr = array();
while ($player = $players->fetch_array()) {
  $newPlayer = array();
  $newPlayer['player_id'] = $player['player_id'];
  $newPlayer['name']      = getPlayerName($mysqli, $mysql_table_prefix, $player['player_id']);
  $newPlayer['lastjoin']  = $player['lastjoin'];
  $newPlayer['lastleave'] = $player['lastleave'];
  $newPlayer['traveled']  = getPlayerStat($mysqli, $mysql_table_prefix, $player['player_id'], 'move');
  $newPlayer['broke']     = getPlayerStat($mysqli, $mysql_table_prefix, $player['player_id'], 'broken');
  $newPlayer['placed']    = getPlayerStat($mysqli, $mysql_table_prefix, $player['player_id'], 'placed');
  $newPlayer['playtime']  = getPlaytime($mysqli, $mysql_table_prefix, $player['player_id']);
  
  $arr[] = $newPlayer;
}

echo json_encode($arr);
?>