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
  <!-- Some SEO and META -->
  <meta charset="utf-8">

<?php if ($navPage == "home") { ?>
  <meta name="description" content="A Minecraft server statistics interface for <?php echo($server_name); ?>. Powered by Fluid MC Stats.">
<?php } elseif ($navPage == "top-players") { ?>
  <meta name="description" content="Top players on <?php echo($server_name); ?>. Powered by Fluid MC Stats.">
<?php } elseif ($navPage == "server-stats") { ?>
  <meta name="description" content="Server statistics for <?php echo($server_name); ?>. Powered by Fluid MC Stats.">
<?php } elseif ($navPage == "search") { ?>
  <meta name="description" content="Search. Powered by Fluid MC Stats.">
<?php } elseif ($navPage == "player-list") { ?>
  <meta name="description" content="Player list for <?php echo($server_name); ?>. Powered by Fluid MC Stats.">
<?php } elseif ($navPage == "player") { ?>
  <meta name="description" content="<?php echo($player); ?>&apos;s statistics on <?php echo($server_name); ?>. Powered by Fluid MC Stats.">
<?php } else { ?>
  <meta name="description" content="Unknown page. Powered by Fluid MC Stats.">
<?php } ?>

  <meta name="author" content="AccountProductions, DevelopGravity, Lolmewn, and <?php echo($server_name); ?>">
<!-- /Some SEO and META -->

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
