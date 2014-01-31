<?php

$file = "../../config_tmp.php";

$reading = fopen($file, 'r');
$writing = fopen($file . ".tmp", 'w');

$replaced = false;

while (!feof($reading)) {
    $line = fgets($reading);

    foreach ($_POST as $key => $value) {
        if (stristr($line, $key)) {
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

function getDefault($key){
    switch($key){
        case "":
            
    }
}