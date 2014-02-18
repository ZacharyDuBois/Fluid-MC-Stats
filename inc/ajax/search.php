<?php

include __DIR__ . "/../../config.php";
include __DIR__ . "/../db.php";
include __DIR__ . "/../util.php";

if(!isset($_POST['page']) || !isset($_POST['finder'])){
    die(json_encode("POST not correct"));
}

$page = $_POST['page'];
$finder = $_POST['finder'];

if(!is_numeric($page)){
    die(json_encode("Page is not a number (???)"));
}

$players = findPlayer($mysqli, $mysql_table_prefix, $finder, $page);
if(!$players || empty($players)){
    die(json_encode("Query failed, or no players are found"));
}

echo json_encode($players);