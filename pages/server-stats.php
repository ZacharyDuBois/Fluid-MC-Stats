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
        <title><?php echo $site_name; ?> - Server Stats</title>
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
                    <li class="active"><a href="server-stats.php"><i class="fa fa-hdd-o"></i> Server Stats</a></li>
                    <li><a href="top-players.php"><i class="fa fa-bar-chart-o"></i> Top Players</a></li>
                    <li><a href="player-list.php"><i class="fa fa-list"></i> Player List</a></li>
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
                            <li class="active"><i class="fa fa-hdd-o"></i> Server Stats</li>
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
                            <h3 class="panel-title"><i class="fa fa-hdd-o"></i> Server Stats</h3>
                        </div>
                        <div class="panel-body">
                            <h3>Current Server Stats</h3>
                            <hr>
                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-bordered">
                                    <!-- TODO: Unit conversions + Plural wording + Rounding to nearest tenth for all units & words. -->
                                    <thead>
                                        <tr>
                                            <th>Measurement</th>
                                            <th>Total</th>
                                            <th>Average</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Players</th>
                                            <td><?php 
                                            $amountOfPlayers = getAmountOfPlayers($mysqli, $mysql_table_prefix, $required_global_stats_time);
                                            echo $amountOfPlayers ?> Players</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th>Playtime</th>
                                            <?php
                                                $value = getServerTotal($mysqli, $mysql_table_prefix, "playtime");
                                                echo "<td>" . convert_playtime($value) . "</td>";
                                                echo "<td>" . convert_playtime($value / $amountOfPlayers) . "</td>";
                                            ?>
                                        </tr>
                                        <tr>
                                            <th>Travel</th>
                                            <?php
                                                $value = getServerTotal($mysqli, $mysql_table_prefix, "move");
                                                echo "<td>" . $value . "</td>";
                                                echo "<td>" . $value / $amountOfPlayers . "</td>";
                                            ?>
                                        </tr>
                                        <tr>
                                            <th>Blocks Broken</th>
                                            <?php
                                                $value = getServerTotal($mysqli, $mysql_table_prefix, "broken");
                                                echo "<td>" . $value . "</td>";
                                                echo "<td>" . $value / $amountOfPlayers . "</td>";
                                            ?>
                                        </tr>
                                        <tr>
                                            <th>Blocks Placed</th>
                                            <?php
                                                $value = getServerTotal($mysqli, $mysql_table_prefix, "placed");
                                                echo "<td>" . $value . "</td>";
                                                echo "<td>" . $value / $amountOfPlayers . "</td>";
                                            ?>
                                        </tr>
                                        <tr>
                                            <th>Deaths</th>
                                            <?php
                                                $value = getServerTotal($mysqli, $mysql_table_prefix, "death");
                                                echo "<td>" . $value . "</td>";
                                                echo "<td>" . $value / $amountOfPlayers . "</td>";
                                            ?>
                                        </tr>
                                        <tr>
                                            <th>Kills</th>
                                            <?php
                                                $value = getServerTotal($mysqli, $mysql_table_prefix, "kill");
                                                echo "<td>" . $value . "</td>";
                                                echo "<td>" . $value / $amountOfPlayers . "</td>";
                                            ?>
                                        </tr>
                                        <tr>
                                            <th>Arrows Fired</th>
                                            <?php
                                                $value = getServerTotal($mysqli, $mysql_table_prefix, "arrows");
                                                echo "<td>" . $value . "</td>";
                                                echo "<td>" . $value / $amountOfPlayers . "</td>";
                                            ?>
                                        </tr>
                                        <tr>
                                            <th>Collected EXP</th>
                                            <?php
                                                $value = getServerTotal($mysqli, $mysql_table_prefix, "exp");
                                                echo "<td>" . $value . "</td>";
                                                echo "<td>" . $value / $amountOfPlayers . "</td>";
                                            ?>
                                        </tr>
                                        <tr>
                                            <th>Fish Caught</th>
                                            <?php
                                                $value = getServerTotal($mysqli, $mysql_table_prefix, "fish");
                                                echo "<td>" . $value . " Fish</td>";
                                                echo "<td>" . $value / $amountOfPlayers . " Fish</td>";
                                            ?>
                                        </tr>
                                        <tr>
                                            <th>Total Damage Taken</th>
                                            <?php
                                                $value = getServerTotal($mysqli, $mysql_table_prefix, "damage");
                                                echo "<td>" . $value . "</td>";
                                                echo "<td>" . $value / $amountOfPlayers . "</td>";
                                            ?>
                                        </tr>
                                        <tr>
                                            <th>Food Consumed</th>
                                            <?php
                                                $value = getServerTotal($mysqli, $mysql_table_prefix, "consumed");
                                                echo "<td>" . $value . "</td>";
                                                echo "<td>" . $value / $amountOfPlayers . "</td>";
                                            ?>
                                        </tr>
                                        <tr>
                                            <th>Crafted Items</th>
                                            <?php
                                                $value = getServerTotal($mysqli, $mysql_table_prefix, "crafted");
                                                echo "<td>" . $value . "</td>";
                                                echo "<td>" . $value / $amountOfPlayers . "</td>";
                                            ?>
                                        </tr>
                                        <tr>
                                            <th>Eggs Thrown</th>
                                            <?php
                                                $value = getServerTotal($mysqli, $mysql_table_prefix, "eggs");
                                                echo "<td>" . $value . "</td>";
                                                echo "<td>" . $value / $amountOfPlayers . "</td>";
                                            ?>
                                        </tr>
                                        <tr>
                                            <th>Tools Broken</th>
                                            <?php
                                                $value = getServerTotal($mysqli, $mysql_table_prefix, "toolsbroken");
                                                echo "<td>" . $value . "</td>";
                                                echo "<td>" . $value / $amountOfPlayers . "</td>";
                                            ?>
                                        </tr>
                                        <tr>
                                            <th>Commands</th>
                                            <?php
                                                $value = getServerTotal($mysqli, $mysql_table_prefix, "commands");
                                                echo "<td>" . $value . "</td>";
                                                echo "<td>" . $value / $amountOfPlayers . "</td>";
                                            ?>
                                        </tr>
                                        <tr>
                                            <th>Votes</th>
                                            <?php
                                                $value = getServerTotal($mysqli, $mysql_table_prefix, "votes");
                                                echo "<td>" . $value . "</td>";
                                                echo "<td>" . $value / $amountOfPlayers . "</td>";
                                            ?>
                                        </tr>
                                        <tr>
                                            <th>Items Dropped</th>
                                            <?php
                                                $value = getServerTotal($mysqli, $mysql_table_prefix, "dropped");
                                                echo "<td>" . $value . "</td>";
                                                echo "<td>" . $value / $amountOfPlayers . "</td>";
                                            ?>
                                        </tr>
                                        <tr>
                                            <th>Items Picked Up</th>
                                            <?php
                                                $value = getServerTotal($mysqli, $mysql_table_prefix, "pickedup");
                                                echo "<td>" . $value . "</td>";
                                                echo "<td>" . $value / $amountOfPlayers . "</td>";
                                            ?>
                                        </tr>
                                        <tr>
                                            <th>Teleports</th>
                                            <?php
                                                $value = getServerTotal($mysqli, $mysql_table_prefix, "teleport");
                                                echo "<td>" . $value . "</td>";
                                                echo "<td>" . $value / $amountOfPlayers . "</td>";
                                            ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <em>*Only includes data of players with more than 1 hour of playtime.</em>
                            <!-- TODO: Above is defined in config.php -->
                        </div>
                        <div class="panel-footer">
                            <em>Last Generated: 18-12-13 11:01pm EDT</em>
                            <!-- TODO: Make caching and auto regeneration of this page to avoid the slowness. -->
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
                    $page = "server-stats";
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
    </body>
</html>
