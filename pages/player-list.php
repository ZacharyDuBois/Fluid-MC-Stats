<?php
/**
 * Copyright (c) AccountProductions and Lolmewn 2014. All Rights Reserved.
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once __DIR__ . '/../config.php';
include_once __DIR__ . '/../inc/db.php';
include_once __DIR__ . '/../inc/queries.php';
include_once __DIR__ . '/../inc/util.php';

$pagenr = isset($_GET['page']) ? $_GET['page'] : 1;
$totalPages = getAmountOfPlayers($mysqli, $mysql_table_prefix, 0);
?>

<!DOCTYPE html>
<!--
  ~ Copyright (c) AccountProductions and Lolmewn 2014. All Rights Reserved.
-->

<html>
    <head>
        <title><?php echo $site_name ?> - Player List</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="../css/custom.css">
        <!-- TODO: Keep correct paths but local links to avoid XSS -->
    </head>
    <body>

        <?php
        $page = "player-list";
        include "../inc/navbar.php";
        ?>

        <!-- Location -->
        <div class="container content-container">
            <div class="hidden-sm">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <ol class="breadcrumb">
                            <li><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
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
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input name="name" type="text" class="form-control" placeholder="Find A Player">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-default">
                                            Find <i class="fa fa-chevron-right"></i>
                                        </button>
                                    </span>
                                </div>
                            </form>
                            <ul class="pager">
                                <li class="previous<?php if ($pagenr == 1) echo ' disabled'; ?>"><a href="javascript:void(0)" onclick="fetchPage(<?php echo $pagenr - 1 ?>)">&larr; Older</a></li>
                                <li class="next<?php if ($pagenr == $totalPages) echo ' disabled'; ?>"><a href="javascript:void(0)" onclick="fetchPage(<?php echo $pagenr + 1 ?>)">Newer &rarr;</a></li>
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
                                        include "../inc/pages/player-list-getter.php";
                                        $players = getPlayerList($mysqli, $mysql_table_prefix, 1);
                                        while ($player = $players->fetch_array()) {
                                            $playerName = getPlayerName($mysqli, $mysql_table_prefix, $player['player_id']);
                                            echo "<tr>";
                                            echo "<td><a href='player.php?id=" . $player['player_id'] . "'>"
                                            . "<img src='" . $avatar_service_uri . $playerName . "/16' class='img-circle avatar-list-icon'>"
                                            . " " . $playerName . "</a></td>";
                                            echo "<td>";
                                            if ($player['lastjoin'] > $player['lastleave']) {
                                                //online now
                                                echo "Online now!";
                                            } else {
                                                echo "<abbr class='timeago' title='" . date("c", strtotime($player['lastleave'])) . "'>" . nicetime($player['lastleave']) . "</abbr>";
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
                                    <li<?php if ($pagenr == 1) echo ' class="disabled"'; ?>><a href="javascript:void(0)" onclick="fetchPage(<?php echo $pagenr - 1 ?>)">&laquo;</a></li> <!-- Only disable when page one -->
                                    <li<?php if ($pagenr == 1) echo ' class="active"'; ?>><a href="javascript:void(0)" onclick="fetchPage(this)"><?php echo $pagenr <= 2 ? "1" : ($totalPages - $pagenr <= 1 ? $totalPages - 4 : $pagenr - 2) ?></a></li>
                                    <?php if ($totalPages > 2) { ?>
                                        <li<?php if ($pagenr == 2) echo ' class="active"'; ?>><a href="javascript:void(0)" onclick="fetchPage(this)"><?php echo $pagenr <= 2 ? "2" : ($totalPages - $pagenr <= 1 ? $totalPages - 3 : $pagenr - 1) ?></a></li>
                                    <?php }
                                    ?>
                                    <?php if ($totalPages > 3) { ?>
                                        <li<?php if ($pagenr != 1 && $pagenr != 2 && $pagenr != $totalPages && $pagenr != $totalPages - 1) echo ' class="active"'; ?>><a href="javascript:void(0)" onclick="fetchPage(this)"><?php echo ($totalPages - $pagenr) <= 2 ? ($totalPages - 2) : ($pagenr > 2 ? $pagenr : "3") ?></a></li>
                                    <?php } ?>
                                    <?php if ($totalPages > 4) { ?>
                                        <li<?php if ($pagenr == $totalPages - 1) echo ' class="active"'; ?>><a href="javascript:void(0)" onclick="fetchPage(this)"><?php echo $pagenr <= 2 ? "4" : ($totalPages - $pagenr <= 1 ? $totalPages - 1 : $pagenr + 1) ?></a></li>
                                    <?php } ?>
                                    <?php if ($totalPages > 5) { ?>
                                        <li<?php if ($pagenr == $totalPages) echo ' class="active"'; ?>><a href="javascript:void(0)" onclick="fetchPage(this)"><?php echo $pagenr <= 2 ? "5" : ($totalPages - $pagenr <= 1 ? $totalPages : $pagenr + 2) ?></a></li>
                                    <?php } ?>
                                    <li<?php if ($pagenr == $totalPages) echo ' class="disabled"'; ?>><a href="javascript:void(0)" onclick="fetchPage(<?php echo $pagenr + 1 ?>)">&raquo;</a></li>
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
                        <p class="make-center"><?php
                            if (!empty($custom_footer_text)) {
                                echo "[" . $custom_footer_text . "]";
                            }
                            ?> <i class="fa fa-info-circle"></i> Fluid MC Stats v0.0.1
                            Pre-Alpha is &copy; Copyright <a href="http://accountproductions.com/">AccountProductions</a> and <a
                                href="http://lolmewn.nl">Lolmewn</a>, 2014. All rights reserved.</p>
                        <!-- DND: Keep this link here! This is copyrighted content -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /Footer -->

        <!-- TODO: Keep correct paths but local links to avoid XSS -->
        <script src="../js/jquery-2.1.0.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../js/d3.v3.min.js"></script>
        <script src='../js/jquery.timeago.js'></script>
        <script src='../js/player-list-script.js'></script>
        <script type="text/javascript">
                                        jQuery(document).ready(function() {
                                            jQuery("abbr.timeago").timeago();
                                        });
        </script>
    </body>
</html>
