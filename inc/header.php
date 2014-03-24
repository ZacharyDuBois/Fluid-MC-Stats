<?php
/**
 * Copyright (c) AccountProductions and Lolmewn 2014. All Rights Reserved.
 */
include_once '../config.php';
?>
<title><?php echo $site_name; ?> - <?php if ($navPage == "home") {
    echo "Home";
  } elseif ($navPage == "top-players") {
    echo "Top Players";
  } elseif ($navPage == "server-stats") {
    echo "Server Statistics";
  } elseif ($navPage == "search") {
    echo("Search");
  } elseif ($navPage == "player-list") {
    echo("Player List");
  } elseif ($navPage == "player") {
    echo("Player - " . $player);
  } else {
    echo("Unknown Title");
  } ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="<?php if (!empty($custom_hosted_uri)) {
  echo($custom_hosted_uri);
} elseif ($navPage != "home") {
  echo "../";
} else {
  echo("");
} ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="<?php if (!empty($custom_hosted_uri)) {
  echo($custom_hosted_uri);
} elseif ($navPage != "home") {
  echo "../";
} else {
  echo("");
} ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php if (!empty($custom_hosted_uri)) {
  echo($custom_hosted_uri);
} elseif ($navPage != "home") {
  echo "../";
} else {
  echo("");
} ?>css/custom.css" rel="stylesheet">
