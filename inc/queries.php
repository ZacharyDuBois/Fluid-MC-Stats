<?php

/**
* Copyright (c) AccountProductions and Lolmewn 2014. All Rights Reserved.
*/

function getPlayerId($mysqli, $mysql_table_prefix, $player) {
    $query = $mysqli->prepare("SELECT player_id FROM " . $mysql_table_prefix . "players WHERE name=?");
    $query->bind_param("s", $player);
    $query->execute();
    $id = NULL;
    $query->bind_result($id);
    $query->fetch();
    return $id;
}

function getPlayerName($mysqli, $mysql_table_prefix, $player_id) {
    $query = $mysqli->prepare("SELECT name FROM " . $mysql_table_prefix . "players WHERE player_id=?");
    $query->bind_param("i", $player_id);
    $query->execute();
    $name = NULL;
    $query->bind_result($name);
    $query->fetch();
    return $name;
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
