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
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="../css/custom.css">
        <!-- TODO: Keep correct paths but local links to avoid XSS -->
    </head>
    <body>

        <!-- Navbar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

            <!-- Mobile -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.php"><i class="fa <?php echo $fa_icon; ?>"></i> <?php echo $site_name; ?></a>
            </div>
            <!-- /Mobile -->

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="server-stats.php"><i class="fa fa-hdd-o"></i> Server Stats</a></li>
                    <li><a href="top-players.php"><i class="fa fa-bar-chart-o"></i> Top Players</a></li>
                    <li class="active"><a href="player-list.php"><i class="fa fa-list"></i> Player List</a></li>
                </ul>
                <form class="navbar-form navbar-right" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Player Name">
                    </div>
                    <button type="submit" class="btn btn-default">Find <i class="fa fa-chevron-right"></i></button>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-link"></i> Links <b
                                class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <?php
                            if (empty($custom_links)) {
                                echo "No links here!";
                            }
                            foreach ($custom_links as $key => $link) {
                                echo "<li><a href='" . $link . "'>" . $key . "</a></li>";
                            }
                            ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /Navbar -->

        <!-- Location -->
        <div class="container content-container">
            <div class="hidden-sm">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <ol class="breadcrumb">
                            <li><a href="../index.php">Home</a></li>
                            <li><a href="player-list.php">Player List</a></li>
                            <li class="active"><i class="fa fa-user"></i> Player</li>
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
                                    <thead>
                                        <tr>
                                            <th>Measurement</th>
                                            <th>Data</th>
                                            <th>Server Average</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th colspan="3"><p class="make-center">Example Data</p></th>
                                    <!-- TODO: Remove -->
                                    </tr>
                                    <tr>
                                        <th>Playtime</th>
                                        <td><?php echo convert_playtime(getPlaytime($mysqli, $mysql_table_prefix, $player_id)); ?></td>
                                        <td><?php echo convert_playtime(getServerAverage($mysqli, $mysql_table_prefix, "playtime")); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Travel</th> 
                                        <td><?php echo getPlayerStat($mysqli, $mysql_table_prefix, "move") ?></td>
                                        <td><?php echo getServerAverage($mysqli, $mysql_table_prefix, "move"); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Blocks Broken</th>
                                        <td><?php echo getPlayerStat($mysqli, $mysql_table_prefix, "broken") ?></td>
                                        <td><?php echo getServerAverage($mysqli, $mysql_table_prefix, "broken"); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Blocks Placed</th>
                                        <td><?php echo getPlayerStat($mysqli, $mysql_table_prefix, "placed") ?></td>
                                        <td><?php echo getServerAverage($mysqli, $mysql_table_prefix, "placed"); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Deaths</th>
                                        <td><?php echo getPlayerStat($mysqli, $mysql_table_prefix, "death") ?></td>
                                        <td><?php echo getServerAverage($mysqli, $mysql_table_prefix, "death"); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Kills</th>
                                        <td><?php echo getPlayerStat($mysqli, $mysql_table_prefix, "kill") ?></td>
                                        <td><?php echo getServerAverage($mysqli, $mysql_table_prefix, "kill"); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Arrows Fired</th>
                                        <td><?php echo getPlayerStat($mysqli, $mysql_table_prefix, "arrows") ?></td>
                                        <td><?php echo getServerAverage($mysqli, $mysql_table_prefix, "arrows"); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Collected EXP</th>
                                        <td><?php echo getPlayerStat($mysqli, $mysql_table_prefix, "exp") ?></td>
                                        <td><?php echo getServerAverage($mysqli, $mysql_table_prefix, "exp"); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Fish Caught</th>
                                        <td><?php echo getPlayerStat($mysqli, $mysql_table_prefix, "fish") ?></td>
                                        <td><?php echo getServerAverage($mysqli, $mysql_table_prefix, "fish"); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Total Damage Taken</th>
                                        <td><?php echo getPlayerStat($mysqli, $mysql_table_prefix, "damage") ?></td>
                                        <td><?php echo getServerAverage($mysqli, $mysql_table_prefix, "damage"); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Food Consumed</th>
                                        <td><?php echo getPlayerStat($mysqli, $mysql_table_prefix, "consumed") ?></td>
                                        <td><?php echo getServerAverage($mysqli, $mysql_table_prefix, "consumed"); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Crafted Items</th>
                                        <td><?php echo getPlayerStat($mysqli, $mysql_table_prefix, "crafted") ?></td>
                                        <td><?php echo getServerAverage($mysqli, $mysql_table_prefix, "crafted"); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Eggs Thrown</th>
                                        <td><?php echo getPlayerStat($mysqli, $mysql_table_prefix, "eggs") ?></td>
                                        <td><?php echo getServerAverage($mysqli, $mysql_table_prefix, "eggs"); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tools Broken</th>
                                        <td><?php echo getPlayerStat($mysqli, $mysql_table_prefix, "toolsbroken") ?></td>
                                        <td><?php echo getServerAverage($mysqli, $mysql_table_prefix, "toolsbroken"); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Commands</th>
                                        <td><?php echo getPlayerStat($mysqli, $mysql_table_prefix, "commands") ?></td>
                                        <td><?php echo getServerAverage($mysqli, $mysql_table_prefix, "commands"); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Votes</th>
                                        <td><?php echo getPlayerStat($mysqli, $mysql_table_prefix, "votes") ?></td>
                                        <td><?php echo getServerAverage($mysqli, $mysql_table_prefix, "votes"); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Items Dropped</th>
                                        <td><?php echo getPlayerStat($mysqli, $mysql_table_prefix, "dropped") ?></td>
                                        <td><?php echo getServerAverage($mysqli, $mysql_table_prefix, "dropped"); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Items Picked Up</th>
                                        <td><?php echo getPlayerStat($mysqli, $mysql_table_prefix, "pickedup") ?></td>
                                        <td><?php echo getServerAverage($mysqli, $mysql_table_prefix, "pickedup"); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Teleports</th>
                                        <td><?php echo getPlayerStat($mysqli, $mysql_table_prefix, "teleport") ?></td>
                                        <td><?php echo getServerAverage($mysqli, $mysql_table_prefix, "teleport"); ?></td>
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
                    <?php include "../inc/serverstatusui.php"; ?>
                    <!-- /Server status -->

                    <!-- Quick Links -->
                    <?php
                    $page = "player-list";
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
                            Pre-Alpha is &copy; Copyright <a href="http://developgravity.com/">Develop Gravity</a> and <a
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
    </body>
</html>
