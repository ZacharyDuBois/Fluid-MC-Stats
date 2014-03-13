<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (file_exists("../config.php")) {
  include_once '../config.php';
} else {
  die("Config not found");
}
if (!isset($_GET['name'])) {
  die("No player specified. <a href='../index.php'>Go back to homepage?</a>");
}
include_once '../inc/db.php';
include_once '../inc/util.php';

$playerName = $_GET['name'];

$pagenr = 1;
if (isset($_GET['page'])) {
  $pagenr = $_GET['page'];
}

$totalPlayers = findPlayerAmount($mysqli, $mysql_table_prefix, $playerName);
$totalPages = (int)($totalPlayers / 15) + ($totalPlayers % 15 != 0 ? 1 : 0);
if ($pagenr > $totalPages && $totalPages != 0) {
  $pagenr = $totalPages;
}
?>

<!DOCTYPE html>
<!--
  ~ Copyright (c) AccountProductions and Lolmewn 2014. All Rights Reserved.
-->
<html>
<head>
  <title><?php echo $site_name ?> - Search</title>
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
$page = "player-list"; //for having an active element in navbar and quick links
include "../inc/navbar.php";
?>
<!-- /Navbar -->

<div class="hidden" id="key"><?php echo $playerName; ?></div>

<!-- Location -->
<div class="container content-container">
  <div class="hidden-sm">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <ol class="breadcrumb">
          <li><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
          <li><a href="player-list.php"><i class="fa fa-list"></i> Player List</a></li>
          <li class="active"><i class="fa fa-search"></i> Search</li>
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
          <h3 class="panel-title"><i class="fa fa-search"></i> Search</h3>
        </div>
        <div class="panel-body">
          <p>Search for players here.</p>

          <form role="search" action='search.php'>
            <div class="input-group input-group-lg">
              <span class="input-group-addon"><i class="fa fa-user"></i></span>
              <input name='name' type="text" class="form-control" placeholder="Find A Player">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-default">
                                          Find <i class="fa fa-chevron-right"></i>
                                        </button>
                                    </span>
            </div>
          </form>
          <ul class="pager">
            <li class="previous<?php if ($pagenr == 1) echo ' disabled'; ?>"><a href="javascript:void(0)" onclick="fetchPage(<?php echo $pagenr - 1 ?>)">&larr; Older</a></li>
            <li class="next<?php if ($pagenr == $totalPages || $totalPages == 0) echo ' disabled'; ?>"><a href="javascript:void(0)" onclick="fetchPage(<?php echo $pagenr + 1 ?>)">Newer &rarr;</a></li>
          </ul>
          <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered">
              <thead>
              <tr>
                <th>Player</th>
                <th>Last Online</th>
              </tr>
              </thead>
              <tbody id="search-list">
              <?php
              $players = findPlayer($mysqli, $mysql_table_prefix, $playerName, $pagenr);
              if (empty($players)) {
                ?>
                <tr>
                  <th colspan='2'><p class="make-center">No players found having '<?php echo $playerName ?>' in their name</p></th>
                </tr>
              <?php
              } else {
                foreach ($players as $player) {
                  echo "<tr>";
                  echo "<td><img src='" . $avatar_service_uri . $player['name'] . "/16' class='img-circle avatar-list-icon'> <a href='player.php?id=" . $player['player_id'] . "'>"
                    . $player['name'] . "</a></td>";
                  $lastjoin = getPlayerStat($mysqli, $mysql_table_prefix, $player['player_id'], "lastjoin");
                  $lastleave = getPlayerStat($mysqli, $mysql_table_prefix, $player['player_id'], "lastleave");
                  if ($lastjoin > $lastleave) {
                    echo "<td>Online now!</td>";
                  } else {
                    if ($lastleave == 0) {
                      echo "<td>Not recorded</td>";
                    } else {
                      echo "<td><abbr class='timeago' title='" . date("c", $lastleave) . "'>" . $lastleave . "</abbr></td>";
                    }
                  }
                  echo "</tr>";
                }
              }
              ?>
              </tbody>
            </table>
          </div>
          <div class="make-center">
            <ul class="pagination pagination-lg">
              <li<?php if ($pagenr == 1) echo ' class="disabled"'; ?>><a href="javascript:void(0)" onclick="fetchPage(<?php echo $pagenr - 1 ?>, this)">&laquo;</a></li>
              <!-- Only disable when page one -->
              <li<?php if ($pagenr == 1) echo ' class="active"'; ?>><a href="javascript:void(0)" onclick="fetchPage(this)"><?php echo $pagenr <= 2 ? "1" : ($totalPages - $pagenr <= 1 ? $totalPages - 4 : $pagenr - 2) ?></a></li>
              <?php if ($totalPages > 2) { ?>
                <li<?php if ($pagenr == 2) echo ' class="active"'; ?>><a href="javascript:void(0)" onclick="fetchPage(this)"><?php echo $pagenr <= 2 ? "2" : ($totalPages - $pagenr <= 1 ? $totalPages - 3 : $pagenr - 1) ?></a></li>
              <?php
              }
              ?>
              <?php if ($totalPages > 3) { ?>
                <li<?php if ($pagenr != 1 && $pagenr != 2 && $pagenr != $totalPages && $pagenr != $totalPages - 1) echo ' class="active"'; ?>><a href="javascript:void(0)"
                                                                                                                                                 onclick="fetchPage(this)"><?php echo ($totalPages - $pagenr) <= 2 ? ($totalPages - 2) : ($pagenr > 2 ? $pagenr : "3") ?></a>
                </li>
              <?php } ?>
              <?php if ($totalPages > 4) { ?>
                <li<?php if ($pagenr == $totalPages - 1) echo ' class="active"'; ?>><a href="javascript:void(0)" onclick="fetchPage(this)"><?php echo $pagenr <= 2 ? "4" : ($totalPages - $pagenr <= 1 ? $totalPages - 1 : $pagenr + 1) ?></a></li>
              <?php } ?>
              <?php if ($totalPages > 5) { ?>
                <li<?php if ($pagenr == $totalPages) echo ' class="active"'; ?>><a href="javascript:void(0)" onclick="fetchPage(this)"><?php echo $pagenr <= 2 ? "5" : ($totalPages - $pagenr <= 1 ? $totalPages : $pagenr + 2) ?></a></li>
              <?php } ?>
              <li<?php if ($pagenr == $totalPages || $totalPages == 0) echo ' class="disabled"'; ?>><a href="javascript:void(0)" onclick="fetchPage(<?php echo $pagenr + 1 ?>, this)">&raquo;</a></li>
            </ul>
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
        <<<<<<< HEAD
        <p class="make-center"><?php
          if (!empty($custom_footer_text)) {
            echo $custom_footer_text;
          }
          ?> <i class="fa fa-info-circle"></i> Fluid MC Stats v0.0.1
          Pre-Alpha is &copy; Copyright <a href="http://accountproductions.com/">AccountProductions</a> and <a
            href="http://lolmewn.nl">Lolmewn</a>, 2014. All rights reserved.</p>
        =======
        <p class="make-center">
          <?php
          if (!empty($custom_footer_text)) {
            echo $custom_footer_text;
          }
          ?>
          <i class="fa fa-info-circle"></i> Fluid MC Stats <?php echo $fmcs_version ?> is &copy; Copyright
          <a href="http://accountproductions.com/">AccountProductions</a> and <a href="http://lolmewn.nl">Lolmewn</a>,
          2014. All rights reserved.</p>
        >>>>>>> 677da92ae77fb9bfad77ff5c7d491420218f1ffb
        <!-- DND: Keep this link here! This is copyrighted content -->
      </div>
    </div>
  </div>
  <!-- /Footer -->
</div>

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
<script src="<?php if (!empty($custom_hosted_uri)) {
  echo($custom_hosted_uri);
} else {
  echo "../";
} ?>js/search-script.js"></script>
<script src='<?php if (!empty($custom_hosted_uri)) {
  echo($custom_hosted_uri);
} else {
  echo "../";
} ?>js/jquery.timeago.js'></script>
<script type="text/javascript">
  jQuery(document).ready(function () {
    jQuery("abbr.timeago").timeago();
  });
</script>
</body>
</html>
