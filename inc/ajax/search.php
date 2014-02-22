<?php

header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

include __DIR__ . "/../../config.php";
include __DIR__ . "/../db.php";
include __DIR__ . "/../util.php";

if (!isset($_GET['page']) || !isset($_GET['finder'])) {
    die(json_encode("POST not correct, " . var_dump($_GET)));
}

$page = $_GET['page'];
$finder = $_GET['finder'];

$totalPlayers = findPlayerAmount($mysqli, $mysql_table_prefix, $finder);
$totalPages = (int) ($totalPlayers / 15) + ($totalPlayers % 15 != 0 ? 1 : 0);
if ($page > $totalPages && $totalPages != 0) {
    $page = $totalPages;
}

if (!is_numeric($page)) {
    die(json_encode("Page is not a number (???)"));
}

$players = findPlayer($mysqli, $mysql_table_prefix, $finder, $page);
if (!$players || empty($players)) {
    die(json_encode("Query failed, or no players are found"));
}

$arr = array();
array_push($arr, $totalPages);
foreach ($players as $player) {
    $player['lastjoin'] = getPlayerStat($mysqli, $mysql_table_prefix, $player['player_id'], "lastjoin");
    $player['lastleave'] = getPlayerStat($mysqli, $mysql_table_prefix, $player['player_id'], "lastleave");
    array_push($arr, $player);
}
echo json_encode($arr);
