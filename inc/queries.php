/**
* Copyright (c) AccountProductions and Lolmewn 2014. All Rights Reserved.
*/

<?php
include_once __DIR__ . '/db.php';
include_once __DIR__ . '/../config.php';

function getPlayerId($mysqli, $player) {
    $query = $mysqli->prepare("SELECT player_id FROM " . $mysql_table_prefix . "players WHERE name=?");
    $query->bind_param("s", $player);
    $query->execute();
    $id = NULL;
    $query->bind_result($id);
    $query->fetch();
    return $id;
}

function getPlaytime($mysqli, $playerId, $world = NULL) {
    $query = $mysqli->prepare("SELECT playtime FROM " . $mysql_table_prefix . "player WHERE player_id=?" . ($world == NULL ? "" : " AND world=?"));
    if ($world == NULL) {
        $query->bind_param("i", $playerId);
    } else {
        $query->bind_param("is", $playerId, $world);
    }
    $query->execute();
    $playtime = NULL;
    $total = 0;
    $query->bind_result($playtime);
    while ($query->fetch()) {
        $total += $playtime;
    }
    $query->fetch();
    return $total;
}
