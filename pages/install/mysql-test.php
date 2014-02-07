<?php
/*
 * Copyright (c) AccountProductions and Lolmewn 2014. All Rights Reserved.
 */

if (!isset($_POST['mh']) || !isset($_POST['mp']) || !isset($_POST['mdb']) || !isset($_POST['mu']) || !isset($_POST['mpa'])) {
  die("Failed to specify all parameters");
}

$mysqli = new mysqli($_POST['mh'], $_POST['mu'], $_POST['mpa'], $_POST['mdb'], $_POST['mp']);
if ($mysqli->connect_errno) {
  die("Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
}
if (!$mysqli->query("SELECT 1")) {
  die("Failed to execute test query: " . $mysqli->error);
}
echo "Success";
$mysqli->close();