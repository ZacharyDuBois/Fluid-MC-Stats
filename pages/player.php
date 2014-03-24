<!DOCTYPE html>
<!--
  ~ Copyright (c) AccountProductions and Lolmewn 2014. All Rights Reserved.
-->
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (file_exists("../config.php")) {
  include_once '../config.php';
} else {
  die("Config not found");
}
if (!isset($_GET['id'])) {
  die("No player specified. <a href='../index.php'>Go back to homepage?</a>");
}
include_once '../inc/db.php';
include_once '../inc/queries.php';
include_once '../inc/util.php';
$player_id = $_GET['id'];
$player = getPlayerName($mysqli, $mysql_table_prefix, $player_id);
?>
<html>
<head>
  <title><?php echo $site_name; ?> - Player - <?php echo $player; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="<?php if (!empty($custom_hosted_uri)) {
    echo($custom_hosted_uri);
  } else {
    echo "../";
  } ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="<?php if (!empty($custom_hosted_uri)) {
    echo($custom_hosted_uri);
  } else {
    echo "../";
  } ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php if (!empty($custom_hosted_uri)) {
    echo($custom_hosted_uri);
  } else {
    echo "../";
  } ?>css/custom.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<?php
$page = "player-list"; //for having an active element in navbar and quick links
include "../inc/navbar.php";
?>
<!-- /Navbar -->

<!-- Location -->
<div class="container content-container">
  <div class="hidden-sm">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <ol class="breadcrumb">
          <li><a href="../index.php">Home</a></li>
          <li><a href="player-list.php">Player List</a></li>
          <li class="active"><i class="fa fa-user"></i> <?php echo $player ?></li>
        </ol>
      </div>
    </div>
  </div>
  <!-- /Location -->

  <!-- Content -->
  <div class="row">
    <!-- Main Content -->
    <div class="col-md-6 col-md-offset-1">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title"><i class="fa fa-user"></i> Player &dash; <?php echo $player; ?></h3>
        </div>
        <div class="panel-body">
          <p class="make-center">
            <img src="<?php echo $avatar_service_uri . $player; ?>/400" class="img-rounded avatar-player-page">
          </p>

          <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered">
              <!-- TODO: Unit conversions + Plural wording + Rounding to nearest tenth for all units & words. -->
              <?php
              $amountOfPlayers = getAmountOfPlayers($mysqli, $mysql_table_prefix, $required_global_stats_time);
              ?>
              <thead>
              <tr>
                <th>Measurement</th>
                <th>Data</th>
                <th>Server Average (<?php echo $amountOfPlayers ?> players)</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <th>Playtime</th>
                <td><?php echo convert_playtime(getPlaytime($mysqli, $mysql_table_prefix, $player_id)); ?></td>
                <td><?php echo convert_playtime(getServerAverage($mysqli, $mysql_table_prefix, "playtime", $required_global_stats_time)); ?></td>
              </tr>
              <tr>
                <th>Travel</th>
                <td><?php echo getPlayerStat($mysqli, $mysql_table_prefix, $player_id, "move") ?> Meters</td>
                <td><?php echo getServerAverage($mysqli, $mysql_table_prefix, "move", $required_global_stats_time); ?> Meters</td>
              </tr>
              <tr>
                <th>Blocks Broken</th>
                <td><?php echo getPlayerStat($mysqli, $mysql_table_prefix, $player_id, "broken") ?> Blocks</td>
                <td><?php echo getServerAverage($mysqli, $mysql_table_prefix, "broken", $required_global_stats_time); ?> Blocks</td>
              </tr>
              <tr>
                <th>Blocks Placed</th>
                <td><?php echo getPlayerStat($mysqli, $mysql_table_prefix, $player_id, "placed") ?> Blocks</td>
                <td><?php echo getServerAverage($mysqli, $mysql_table_prefix, "placed", $required_global_stats_time); ?> Blocks</td>
              </tr>
              <tr>
                <th>Deaths</th>
                <td><?php echo getPlayerStat($mysqli, $mysql_table_prefix, $player_id, "death") ?> Deaths</td>
                <td><?php echo getServerAverage($mysqli, $mysql_table_prefix, "death", $required_global_stats_time); ?> Deaths</td>
              </tr>
              <tr>
                <th>Kills</th>
                <td><?php echo getPlayerStat($mysqli, $mysql_table_prefix, $player_id, "kill") ?> Kills</td>
                <td><?php echo getServerAverage($mysqli, $mysql_table_prefix, "kill", $required_global_stats_time); ?> Kills</td>
              </tr>
              <tr>
                <th>Arrows Fired</th>
                <td><?php echo getPlayerStat($mysqli, $mysql_table_prefix, $player_id, "arrows") ?> Arrows</td>
                <td><?php echo getServerAverage($mysqli, $mysql_table_prefix, "arrows", $required_global_stats_time); ?> Arrows</td>
              </tr>
              <tr>
                <th>Collected EXP</th>
                <td><?php echo getPlayerStat($mysqli, $mysql_table_prefix, $player_id, "exp") ?> EXP</td>
                <td><?php echo getServerAverage($mysqli, $mysql_table_prefix, "exp", $required_global_stats_time); ?> EXP</td>
              </tr>
              <tr>
                <th>Fish Caught</th>
                <td><?php echo getPlayerStat($mysqli, $mysql_table_prefix, $player_id, "fish") ?> Fish</td>
                <td><?php echo getServerAverage($mysqli, $mysql_table_prefix, "fish", $required_global_stats_time); ?> Fish</td>
              </tr>
              <tr>
                <th>Total Damage Taken</th>
                <td><?php echo getPlayerStat($mysqli, $mysql_table_prefix, $player_id, "damage") ?> Health</td>
                <td><?php echo getServerAverage($mysqli, $mysql_table_prefix, "damage", $required_global_stats_time); ?> Health</td>
              </tr>
              <tr>
                <th>Food Consumed</th>
                <td><?php echo getPlayerStat($mysqli, $mysql_table_prefix, $player_id, "consumed") ?> Foodz</td>
                <td><?php echo getServerAverage($mysqli, $mysql_table_prefix, "consumed", $required_global_stats_time); ?> Foodz</td>
              </tr>
              <tr>
                <th>Crafted Items</th>
                <td><?php echo getPlayerStat($mysqli, $mysql_table_prefix, $player_id, "crafted") ?> Items</td>
                <td><?php echo getServerAverage($mysqli, $mysql_table_prefix, "crafted", $required_global_stats_time); ?> Items</td>
              </tr>
              <tr>
                <th>Eggs Thrown</th>
                <td><?php echo getPlayerStat($mysqli, $mysql_table_prefix, $player_id, "eggs") ?> Eggs</td>
                <td><?php echo getServerAverage($mysqli, $mysql_table_prefix, "eggs", $required_global_stats_time); ?> Eggs</td>
              </tr>
              <tr>
                <th>Tools Broken</th>
                <td><?php echo getPlayerStat($mysqli, $mysql_table_prefix, $player_id, "toolsbroken") ?> Tools</td>
                <td><?php echo getServerAverage($mysqli, $mysql_table_prefix, "toolsbroken", $required_global_stats_time); ?> Tools</td>
              </tr>
              <tr>
                <th>Commands</th>
                <td><?php echo getPlayerStat($mysqli, $mysql_table_prefix, $player_id, "commands") ?> Commands</td>
                <td><?php echo getServerAverage($mysqli, $mysql_table_prefix, "commands", $required_global_stats_time); ?> Commands</td>
              </tr>
              <tr>
                <th>Votes</th>
                <td><?php echo getPlayerStat($mysqli, $mysql_table_prefix, $player_id, "votes") ?> Votes</td>
                <td><?php echo getServerAverage($mysqli, $mysql_table_prefix, "votes", $required_global_stats_time); ?> Votes</td>
              </tr>
              <tr>
                <th>Items Dropped</th>
                <td><?php echo getPlayerStat($mysqli, $mysql_table_prefix, $player_id, "dropped") ?> Items</td>
                <td><?php echo getServerAverage($mysqli, $mysql_table_prefix, "dropped", $required_global_stats_time); ?> Items</td>
              </tr>
              <tr>
                <th>Items Picked Up</th>
                <td><?php echo getPlayerStat($mysqli, $mysql_table_prefix, $player_id, "pickedup") ?> Items</td>
                <td><?php echo getServerAverage($mysqli, $mysql_table_prefix, "pickedup", $required_global_stats_time); ?> Items</td>
              </tr>
              <tr>
                <th>Teleports</th>
                <td><?php echo getPlayerStat($mysqli, $mysql_table_prefix, $player_id, "teleport") ?> Teleports</td>
                <td><?php echo getServerAverage($mysqli, $mysql_table_prefix, "teleport", $required_global_stats_time); ?> Teleports</td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- /Main Content -->

    <!-- Sidebar -->
    <div class="col-md-3 col-md-offset-1">


      <!-- Server status -->
      <?php
      include "../inc/serverstatusui.php";

      include '../inc/quicklinksui.php';
      ?>
      <!-- /Quick Links -->

    </div>
    <!-- /Sidebar -->

  </div>
  <!-- /Content -->

  <!-- Footer -->
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="well well-sm">
        <p class="make-center">
          <?php
          if (!empty($custom_footer_text)) {
            echo $custom_footer_text;
          }
          ?>
          <i class="fa fa-info-circle"></i> Fluid MC Stats <?php echo $fmcs_version ?> is &copy; Copyright
          <a href="http://accountproductions.com/">AccountProductions</a> and <a href="http://lolmewn.nl">Lolmewn</a>,
          2014. All rights reserved.</p>
        <!-- DND: Keep this link here! This is copyrighted content -->
      </div>
    </div>
  </div>
  <!-- /Footer -->
</div>


<script src="<?php if (!empty($custom_hosted_uri)) {
  echo($custom_hosted_uri);
} else {
  echo "../";
} ?>js/jquery-2.1.0.min.js"></script>
<script src="<?php if (!empty($custom_hosted_uri)) {
  echo($custom_hosted_uri);
} else {
  echo "../";
} ?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?php if (!empty($custom_hosted_uri)) {
  echo($custom_hosted_uri);
} else {
  echo "../";
} ?>js/d3.v3.min.js"></script>
</body>
</html>
