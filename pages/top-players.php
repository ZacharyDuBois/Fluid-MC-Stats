<?php
/*
 * Copyright (c) AccountProductions and Lolmewn 2014. All Rights Reserved.
 */
include_once "../config.php";
include_once '../inc/db.php';
include_once '../inc/util.php';
include_once '../inc/queries.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<!--
  ~ Copyright (c) AccountProductions and Lolmewn 2014. All Rights Reserved.
-->

<html>
<head>
  <title><?php echo $site_name; ?> - Top Players</title>
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
  <!-- TODO: Keep correct paths but local links to avoid XSS -->
</head>
<body>

<!-- Navbar -->
<?php
$page = "top-players";
include "../inc/navbar.php";
?>
<!-- /Navbar -->

<!-- Location -->
<div class="container content-container">
  <div class="hidden-sm">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <ol class="breadcrumb">
          <li><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
          <li class="active"><i class="fa fa-bar-chart-o"></i> Top Players</li>
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
          <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Top Players</h3>
        </div>
        <div class="panel-body">
          <p>These are users with current top rankings on the server.</p>

          <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered">
              <!-- TODO: Unit conversions + Plural wording + Rounding to nearest tenth for all units & words. -->
              <thead>
              <tr>
                <th>Rank</th>
                <th>Player</th>
                <th><?php echo getHumanFriendlyStatName($player_top_calc_stat); ?>
              </tr>
              </thead>
              <tbody>
              <?php
              $page = 1;
              $result = getTopPlayers($mysqli, $mysql_table_prefix, $player_top_calc_stat, $page);
              $i = 1 * $page;
              if (!$result) {
                echo $mysqli->error;
              }
              while (($arr = $result->fetch_array()) != NULL) {
                echo "<tr>";
                echo "<th>&num;" . $i++ . "</th>";
                $playerName = getPlayerName($mysqli, $mysql_table_prefix, $arr['player_id']);
                echo "<td><a href='player.php?id=" . $arr['player_id'] . "'><img src='"
                  . $avatar_service_uri . $playerName . "/16' "
                  . "class='img-circle avatar-list-icon'> " . $playerName . "</a></td>";
                echo "<td>" . translateValue($player_top_calc_stat, $arr['value']) . "</td>";
              }
              ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="panel-footer">
          <em>Last Generated: Just now</em>
          <!-- TODO: Make caching and auto regeneration of this page to avoid the slowness.
          Maybe for later. -->
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
</div>
<!-- /Footer -->

<!-- TODO: Keep correct paths but local links to avoid XSS -->
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
