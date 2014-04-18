<?php
/**
 * Copyright (c) AccountProductions and Lolmewn 2014. All Rights Reserved.
 */

header('Content-Type: application/json');

include '../../config.php';
include '../db.php';
include '../util.php';
include '../pages/player-list-getter.php';
include '../queries.php';

if (!isset($_GET['page'])) {
  die(json_encode("POST not correct, " . var_dump($_GET)));
}

$page = $_GET['page'];

$totalPlayers = getAmountOfPlayers($mysqli, $mysql_table_prefix, 0);
$totalPages = (int)($totalPlayers / 15) + ($totalPlayers % 15 != 0 ? 1 : 0);
if ($page > $totalPages) {
  $page = $totalPages;
}

if (!is_numeric($page)) {
  die(json_encode("Page is not a number (???)"));
}

$players = getPlayerList($mysqli, $mysql_table_prefix, $page);
if (!$players || empty($players)) {
  die(json_encode("Query failed, or no players are found"));
}

$arr = array();
array_push($arr, $totalPages);

while ($player = $players->fetch_array()) {
  $newPlayer = array();
  $newPlayer['player_id'] = $player['player_id'];
  $newPlayer['name'] = getPlayerName($mysqli, $mysql_table_prefix, $player['player_id']);
  $newPlayer['lastjoin'] = $player['lastjoin'];
  $newPlayer['lastleave'] = $player['lastleave'];
  array_push($arr, $newPlayer);
}
echo json_encode($arr);
