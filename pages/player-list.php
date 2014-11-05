<?php
/**
 * Copyright (c) AccountProductions and Sybren Gjaltema, 2014. All rights reserved.
 */

$navPage = "player-list";

include_once 'config.php';
include_once 'inc/db.php';
include_once 'inc/queries.php';
include_once 'inc/util.php';

$pagenr = isset($_GET['page']) ? $_GET['page'] : 1;
$totalPages = getAmountOfPlayers($mysqli, $mysql_table_prefix, 0);
?>

<!DOCTYPE html>
<!--
  ~ Copyright (c) AccountProductions and Sybren Gjaltema, 2014. All rights reserved.
-->

<html>
<head>
  <!-- Header -->
  <?php
  include 'inc/header.php';
  ?>
  <!-- /Header -->
</head>
<body>

<?php
include 'inc/navbar.php';
?>

<!-- Location -->
<div class="container content-container">
  <div class="hidden-sm">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <ol class="breadcrumb">
          <li><a href="<?php echo LINKBASE; ?>" title="Home"><i class="fa fa-home"></i> Home</a></li>
          <li class="active"><i class="fa fa-list"></i> Player List</li>
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
          <h3 class="panel-title"><i class="fa fa-list"></i> Player List</h3>
        </div>
        <div class="panel-body">
          <p>This is a list of all players that have played on the server.</p>

          <form role="search" action='search.php'>
            <div class="input-group input-group-lg">
              <span class="input-group-addon"><i class="fa fa-user"></i></span> <input name="name" type="text" class="form-control" placeholder="Find A Player">
              <span class="input-group-btn">
                <button type="submit" class="btn btn-default">
                  Find <i class="fa fa-chevron-right"></i>
                </button>
              </span>
            </div>
          </form>
          <ul class="pager">
            <li class="previous<?php if ($pagenr == 1) echo ' disabled'; ?>"><a href="javascript:void(0)" onclick="fetchPage(<?php echo $pagenr - 1 ?>)">&larr; Older</a></li>
            <li class="next<?php if ($pagenr == $totalPages || $totalPages == 0) echo ' disabled'; ?>"><a href="javascript:void(0)"
                                                                                                          onclick="fetchPage(<?php echo $pagenr + 1 ?>)">Newer &rarr;</a></li>
          </ul>
          <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered">
              <thead>
              <tr>
                <th>Player</th>
                <th>Last Online</th>
              </tr>
              </thead>

              <tbody id='player-list'> <!-- ZACH NTS: Add in tooltips instead of abbr (don't forget to do it in player-list-search.js too then -->
              <?php
              include "inc/pages/player-list-getter.php";
              $players = getPlayerList($mysqli, $mysql_table_prefix, $pagenr);
              while ($player = $players->fetch_array()) {
                $playerName = getPlayerName($mysqli, $mysql_table_prefix, $player['player_id']);
                echo "<tr>";
                echo "<td><img src='" . $avatar_service_uri . $playerName . "/16' class='img-circle avatar-list-icon'> <a href='".LINKBASE."players/" . $player['player_id'] . "' title='" . $playerName . "&apos;s Stats'>"
                    . $playerName . "</a></td>";
                echo "<td>";
                if ($player['lastjoin'] > $player['lastleave']) {
                  //online now
                  echo "Online now!";
                } else {
                  if ($player['lastleave'] == "0000-00-00 00:00:00") {
                    echo "Not recorded";
                  } else {
                    echo "<abbr class='timeago' title='" . date("c", strtotime($player['lastleave'])) . "'>" . $player['lastleave'] . "</abbr>";
                  }
                }
                echo "</td>";
                echo "</tr>";
              }
              ?>
              </tbody>
            </table>
          </div>
          <div class="make-center">
            <ul class="pagination pagination-lg">
              <li<?php if ($pagenr == 1) echo ' class="disabled"'; ?>><a href="javascript:void(0)" onclick="fetchPage(<?php echo $pagenr - 1 ?>)">&laquo;</a></li>
              <!-- Only disable when page one -->
              <li<?php if ($pagenr == 1) echo ' class="active"'; ?>><a href="javascript:void(0)"
                                                                       onclick="fetchPage(this)"><?php echo $pagenr <= 2 ? "1" : ($totalPages - $pagenr <= 1 ? $totalPages - 4 : $pagenr - 2) ?></a>
              </li>
              <?php if ($totalPages > 2) { ?>
                <li<?php if ($pagenr == 2) echo ' class="active"'; ?>><a href="javascript:void(0)"
                                                                         onclick="fetchPage(this)"><?php echo $pagenr <= 2 ? "2" : ($totalPages - $pagenr <= 1 ? $totalPages - 3 : $pagenr - 1) ?></a>
                </li>
              <?php
              }
              ?>
              <?php if ($totalPages > 3) { ?>
                <li<?php if ($pagenr != 1 && $pagenr != 2 && $pagenr != $totalPages && $pagenr != $totalPages - 1) echo ' class="active"'; ?>><a href="javascript:void(0)"
                                                                                                                                                 onclick="fetchPage(this)"><?php echo ($totalPages - $pagenr) <= 2 ? ($totalPages - 2) : ($pagenr > 2 ? $pagenr : "3") ?></a>
                </li>
              <?php } ?>
              <?php if ($totalPages > 4) { ?>
                <li<?php if ($pagenr == $totalPages - 1) echo ' class="active"'; ?>><a href="javascript:void(0)"
                                                                                       onclick="fetchPage(this)"><?php echo $pagenr <= 2 ? "4" : ($totalPages - $pagenr <= 1 ? $totalPages - 1 : $pagenr + 1) ?></a>
                </li>
              <?php } ?>
              <?php if ($totalPages > 5) { ?>
                <li<?php if ($pagenr == $totalPages) echo ' class="active"'; ?>><a href="javascript:void(0)"
                                                                                   onclick="fetchPage(this)"><?php echo $pagenr <= 2 ? "5" : ($totalPages - $pagenr <= 1 ? $totalPages : $pagenr + 2) ?></a>
                </li>
              <?php } ?>
              <li<?php if ($pagenr == $totalPages || $totalPages == 0) echo ' class="disabled"'; ?>><a href="javascript:void(0)"
                                                                                                       onclick="fetchPage(<?php echo $pagenr + 1 ?>)">&raquo;</a></li>
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
      include 'inc/serverstatusui.php';

      include 'inc/quicklinksui.php';
      ?>
      <!-- /Quick Links -->

    </div>
    <!-- /Sidebar -->

  </div>
  <!-- /Content -->

  <!-- Footer -->
  <?php
  include 'inc/footer.php';
  ?>
  <!-- /Footer -->
</body>
</html>
