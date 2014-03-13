<?php
/*
 * Copyright (c) AccountProductions and Lolmewn 2014. All Rights Reserved.
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

$file = "../../config.php";

$reading = fopen($file, 'r');
$writing = fopen($file . ".tmp", 'w');

$replaced = false;

$inArray = false;

while (!feof($reading)) {
  $line = fgets($reading);
  if (stristr($line, "array(")) {
    $inArray = true;
    fputs($writing, $line);
    writeCustoms($writing);
  }
  if ($inArray && !stristr($line, ");")) {
    continue; //skip old values for array
  }
  if ($inArray) {
    fputs($writing, $line);
    $inArray = false;
    continue;
  }
  foreach ($_POST as $key => $value) {
    if (stristr($line, $key)) {
      if ($value == "") {
        $value = getDefault($key);
        if (!$value) {
          $value = "";
        }
      }
      if ($key == "fa_icon") {
        $value = "fa-" . $value;
      }
      $line = "$" . $key . " = \"" . $value . '";' . PHP_EOL;
      $replaced = true;
    }
  }
  fputs($writing, $line);
}
fclose($reading);
fclose($writing);
// might as well not overwrite the file if we didn't replace anything
if ($replaced) {
  rename($file . ".tmp", $file);
} else {
  unlink($file . ".tmp");
}

echo "Success";

function getDefault($key)
{
  //required fields have a value anyway, only need non-required fields
  switch ($key) {
    case "mc_server_disp_addr":
      return $_POST['mc_server_ip'] . ":" . $_POST['mc_server_port'];
    case "fa_icon":
      return "plus";
  }
  if (stristr($key, "custom")) {
    return false;
  }
}

function writeCustoms($writing)
{
  writeCustom($writing, $_POST['customname1'], $_POST['customvalue1']);
  writeCustom($writing, $_POST['customname2'], $_POST['customvalue2']);
  writeCustom($writing, $_POST['customname3'], $_POST['customvalue3']);
  writeCustom($writing, $_POST['customname4'], $_POST['customvalue4']);
  writeCustom($writing, $_POST['customname5'], $_POST['customvalue5']);
}

function writeCustom($writing, $key, $value)
{
  if ($key == "") {
    return;
  }
  fputs($writing, "  \"" . $key . "\" => \"" . $value . "\"," . PHP_EOL);
}
