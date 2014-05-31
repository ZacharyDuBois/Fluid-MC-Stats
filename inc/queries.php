<?php
/**
 * Copyright (c) AccountProductions and Sybren Gjaltema, 2014. All rights reserved.
 */

function getPlayerId($mysqli, $mysql_table_prefix, $player)
{
  $query = $mysqli->prepare("SELECT player_id FROM " . $mysql_table_prefix . "players WHERE name=?");
  $query->bind_param("s", $player);
  $query->execute();
  $id = null;
  $query->bind_result($id);
  $query->fetch();

  return $id;
}

function getPlayerName($mysqli, $mysql_table_prefix, $player_id)
{
  $query = $mysqli->prepare("SELECT name FROM " . $mysql_table_prefix . "players WHERE player_id=?");
  $query->bind_param("i", $player_id);
  $query->execute();
  $name = null;
  $query->bind_result($name);
  $query->fetch();

  return $name;
}

function getPlaytime($mysqli, $mysql_table_prefix, $player_id, $world = null)
{
  $query = $mysqli->prepare("SELECT playtime FROM " . $mysql_table_prefix . "player WHERE player_id=?" . ($world == null ? "" : " AND world=?"));
  if ($world == null) {
    $query->bind_param("i", $player_id);
  } else {
    $query->bind_param("is", $player_id, $world);
  }
  $query->execute();
  $playtime = null;
  $total = 0;
  $query->bind_result($playtime);
  while ($query->fetch()) {
    $total += $playtime;
  }
  $query->fetch();

  return $total;
}
