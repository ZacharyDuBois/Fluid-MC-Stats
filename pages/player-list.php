<!DOCTYPE html>
<!--
  ~ Copyright (c) AccountProductions and Lolmewn 2014. All Rights Reserved.
-->

<html>
    <head>
        <title>Fluid MC Stats - Player List</title>
        <!-- TODO: Change title dynamicly and replace Fluid MC Stats with $site_name from config.php. -->
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
                <a class="navbar-brand" href="../index.php"><i class="fa fa-plus"></i> Fluid MC Stats</a>
                <!-- TODO: Change Fluid MC Stats to $site_name from config.php -->
                <!-- TODO: Change fa-plus to $fa_icon from config.php -->
            </div>
            <!-- /Mobile -->

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
                    <!-- TODO: Apply class active to li when page is current -->
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
                            <li><a href="#">Not setup...</a></li>
                            <!-- TODO: Links from $custom_links configuration file need to go here. -->
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
                            <li class="active"><i class="fa fa-list"></i> Player List</li>
                            <!-- TODO: Apply class active to li when page is current -->
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
                            <!-- <div class="alert alert-danger">
                                <p><strong><i class="fa fa-exclamation-triangle"></i> Fatal:</strong> Configuration was not
                                    setup
                                    correctly. Possibly you did not set Fluid MC Stats up?</p>
                            </div> -->
                            <!-- TODO: Make this error only visible when the config is incorrect or missing -->
                            <p>This is a list of all players that have played on the server.</p>

                            <form role="search">
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <!-- BUG: Scale is off on group-addon when in jumbotron -->
                                    <input type="text" class="form-control" placeholder="Find A Player">
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
                                        <tr>
                                            <td><a href="player.php"><img src="http://mctar.polardrafting.com/Zachary_DuBois/16"
                                                                           class="img-circle avatar-list-icon"> Zachary_DuBois</a></td>
                                            <td>24-12-13 &commat; 11:22pm</td>
                                        </tr>
                                        <tr>
                                            <td><a href="player.php"><img src="http://mctar.polardrafting.com/Lolmewn/16"
                                                                           class="img-circle avatar-list-icon"> Lolmewn</a></td>
                                            <td>22-12-13 &commat; 10:56pm</td>
                                        </tr>
                                        <tr>
                                            <td><a href="player.php"><img src="http://mctar.polardrafting.com/SomeGuy/16"
                                                                           class="img-circle avatar-list-icon"> SomeGuy</a></td>
                                            <td>22-12-13 &commat; 9:10pm</td>
                                        </tr>
                                        <tr>
                                            <td><a href="player.php"><img src="http://mctar.polardrafting.com/AnotherGuy/16"
                                                                           class="img-circle avatar-list-icon"> AnotherGuy</a></td>
                                            <td>21-12-13 &commat; 8:19am</td>
                                        </tr>
                                        <tr>
                                            <td><a href="player.php"><img src="http://mctar.polardrafting.com/ThisCoolDude/16"
                                                                           class="img-circle avatar-list-icon"> ThisCoolDude</a></td>
                                            <td>20-12-13 &commat; 9:34am</td>
                                        </tr>
                                        <tr>
                                            <td><a href="player.php"><img src="http://mctar.polardrafting.com/ExampleUser/16"
                                                                           class="img-circle avatar-list-icon"> Example User</a></td>
                                            <td>Example Time</td>
                                        </tr>
                                        <tr>
                                            <td><a href="player.php"><img src="http://mctar.polardrafting.com/ExampleUser/16"
                                                                           class="img-circle avatar-list-icon"> Example User</a></td>
                                            <td>Example Time</td>
                                        </tr>
                                        <tr>
                                            <td><a href="player.php"><img src="http://mctar.polardrafting.com/ExampleUser/16"
                                                                           class="img-circle avatar-list-icon"> Example User</a></td>
                                            <td>Example Time</td>
                                        </tr>
                                        <tr>
                                            <td><a href="player.php"><img src="http://mctar.polardrafting.com/ExampleUser/16"
                                                                           class="img-circle avatar-list-icon"> Example User</a></td>
                                            <td>Example Time</td>
                                        </tr>
                                        <tr>
                                            <td><a href="player.php"><img src="http://mctar.polardrafting.com/ExampleUser/16"
                                                                           class="img-circle avatar-list-icon"> Example User</a></td>
                                            <td>Example Time</td>
                                        </tr>
                                        <tr>
                                            <td><a href="player.php"><img src="http://mctar.polardrafting.com/ExampleUser/16"
                                                                           class="img-circle avatar-list-icon"> Example User</a></td>
                                            <td>Example Time</td>
                                        </tr>
                                        <tr>
                                            <td><a href="player.php"><img src="http://mctar.polardrafting.com/ExampleUser/16"
                                                                           class="img-circle avatar-list-icon"> Example User</a></td>
                                            <td>Example Time</td>
                                        </tr>
                                        <tr>
                                            <td><a href="player.php"><img src="http://mctar.polardrafting.com/ExampleUser/16"
                                                                           class="img-circle avatar-list-icon"> Example User</a></td>
                                            <td>Example Time</td>
                                        </tr>
                                        <tr>
                                            <td><a href="player.php"><img src="http://mctar.polardrafting.com/ExampleUser/16"
                                                                           class="img-circle avatar-list-icon"> Example User</a></td>
                                            <td>Example Time</td>
                                        </tr>
                                        <tr>
                                            <td><a href="player.php"><img src="http://mctar.polardrafting.com/ExampleUser/16"
                                                                           class="img-circle avatar-list-icon"> Example User</a></td>
                                            <td>Example Time</td>
                                        </tr>
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
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-link"></i> Quick Links</h3>
                        </div>
                        <div class="panel-body">
                            <div class="list-group">
                                <a href="../index.php" class="list-group-item"><i class="fa fa-home"></i> Home</a>
                                <!-- TODO: Apply class active to li when page is current -->
                                <a href="server-stats.php" class="list-group-item"><i class="fa fa-hdd-o"></i> Server Stats</a>
                                <a href="top-players.php" class="list-group-item"><i class="fa fa-bar-chart-o"></i> Top Players</a>
                                <a href="player-list.php" class="list-group-item active"><i class="fa fa-list"></i> Player List</a>
                            </div>
                            <div class="list-group">
                                <a href="#" class="list-group-item">Not setup...</a>
                                <!-- TODO: Links from $custom_links configuration file need to go here. -->
                            </div>
                        </div>
                    </div>
                    <!-- /Quick Links -->

                </div>
                <!-- /Sidebar -->

            </div>
            <!-- /Content -->

            <!-- Footer -->
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="well well-sm">
                        <!-- TODO: User custom footer text will appear in 'Config defined text here' from config.php -->
                        <p class="make-center">[Config defined text here] <i class="fa fa-info-circle"></i> Fluid MC Stats v0.0.1
                            Pre-Alpha is &copy; Copyright <a href="http://developgravity.com/">Develop Gravity</a> and <a
                                href="http://lolmewn.nl">Lolmewn</a>, 2013. All rights reserved.</p>
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
