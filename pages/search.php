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
$player = $_GET['name'];
?>

<!DOCTYPE html>
<!--
  ~ Copyright (c) AccountProductions and Lolmewn 2014. All Rights Reserved.
-->
<html>
    <head>
        <title><?php echo $site_name ?> - Search</title>
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
                <a class="navbar-brand" href="../index.php"><i class="fa <?php echo $fa_icon ?>"></i> <?php echo $site_name ?></a>
            </div>
            <!-- /Mobile -->

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="server-stats.php"><i class="fa fa-hdd-o"></i> Server Stats</a></li>
                    <li><a href="top-players.php"><i class="fa fa-bar-chart-o"></i> Top Players</a></li>
                    <li><a href="player-list.php"><i class="fa fa-list active"></i> Player List</a></li>
                </ul>
                <form class="navbar-form navbar-right" role="search" action="search.php">
                    <div class="form-group">
                        <input name='name' type="text" class="form-control" placeholder="Player Name">
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
                                    <!-- BUG: Scale is off on group-addon when in jumbotron -->
                                    <input name='name' type="text" class="form-control" placeholder="Find A Player">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-default">
                                            Find <i class="fa fa-chevron-right"></i>
                                        </button>
                                    </span>
                                </div>
                            </form>
                            <ul class="pager">
                                <li class="previous disabled"><a href="#">&larr; Older</a></li>
                                <li class="next"><a href="#">Newer &rarr;</a></li>
                            </ul>
                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Player</th>
                                            <th>Last Online</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $players = findPlayer($mysqli, $mysql_table_prefix, $player);
                                        if (empty($players)) {
                                            ?>
                                            <tr><th colspan='2'><p class="make-center">>No players found having '<?php echo $player ?>' in their name</p></th></tr>
                                        <?php
                                        }else{
                                            foreach ($players as $player) {
                                                echo "<tr>";
                                                echo "<td><a href='player.php?id=" . $player['player_id'] . "'><img src='"
                                                        . $avatar_service_uri . $player['name'] . "/16' class='img-circle avatar-list-icon'> "
                                                        . $player['name'] . "</a></td>";
                                                $lastjoin = getPlayerStat($mysqli, $mysql_table_prefix, $player['player_id'], "lastjoin");
                                                $lastleave = getPlayerStat($mysqli, $mysql_table_prefix, $player['player_id'], "lastleave");
                                                if($lastjoin > $lastleave){
                                                    echo "<td>Online now!</td>";
                                                }else{
                                                    echo "<td>" . date('Y-m-d H:i:s', $lastleave) . "</td>";
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
                                    <li class="disabled"><a href="#">&laquo;</a></li>
                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                    <li><a href="#">&raquo;</a></li>
                                </ul>
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
                            Pre-Alpha is &copy; Copyright <a href="http://accountproductions.com/">AccountProductions</a> and <a
                                href="http://lolmewn.nl">Lolmewn</a>, 2014. All rights reserved.</p>
                        <!-- DND: Keep this link here! This is copyrighted content -->
                    </div>
                </div>
            </div>
            <!-- /Footer -->
        </div>

        <!-- TODO: Keep correct paths but local links to avoid XSS -->
        <script src="../js/jquery-2.1.0.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../js/d3.v3.min.js"></script>
    </body>
</html>
