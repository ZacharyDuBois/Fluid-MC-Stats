<!DOCTYPE html>
<!--
  ~ Copyright (c) AccountProductions and Lolmewn 2014. All Rights Reserved.
-->
<?php
if (!file_exists('config.php')) {
  echo "<h1>config.php missing!</h1>";
  die();
}
include 'config.php';

$navPage = "home";

if ($mysql_host == '' && file_exists("pages/install/")) {
  $http = ($_SERVER['HTTPS'] ? 'https://' : 'http://');
  $installLoc = $http . $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"] . "pages/install/install.php";
  header("Location: " . $installLoc);
  die();
}
if ($mysql_host == '') {
  die("Config misconfigured and install folder is not at default location, can't launch website");
}
if (file_exists("pages/install/")) {
  die("Security Issues! Please move or delete the installation folder!");
}
?>
<html>
<head>
  <!-- Header -->
  <?php
  include 'inc/header.php';
  ?>
  <!-- /Header -->
</head>
<body>

<!-- Navbar -->
<?php
include 'inc/navbar.php';
?>
<!-- /Navbar -->

<!-- Location -->
<div class="container content-container">
  <div class="hidden-sm">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <ol class="breadcrumb">
          <li class="active"><i class="fa fa-home"></i> Home</li>
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
          <h3 class="panel-title"><i class="fa fa-home"></i> Home</h3>
        </div>
        <div class="panel-body">
          <div class="jumbotron">
            <h1>Welcome!</h1>

            <p>to the new Fluid MC Stats interface for the <?php echo $server_name; ?> server, powered by <a href="http://developgravity.com/">DevelopGravity</a> and <a href="http://lolmewn.nl">Lolmewn</a>.</p>

            <p>Get started by searching for your stats on this server or...</p>

            <form role="search" action='pages/search.php'>
              <div class="input-group input-group-lg">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input name='name' type="text" class="form-control" placeholder="Username">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-default">
                                              Find <i class="fa fa-chevron-right"></i>
                                            </button>
                                        </span>
              </div>
            </form>
            <p>Explore...</p>

            <div class="list-group">
              <a href="index.php" class="list-group-item active"><i class="fa fa-home"></i> Home</a>
              <a href="pages/server-stats.php" class="list-group-item"><i class="fa fa-hdd-o"></i> Server Stats</a>
              <a href="pages/top-players.php" class="list-group-item"><i class="fa fa-bar-chart-o"></i> Top Players</a>
              <a href="pages/player-list.php" class="list-group-item"><i class="fa fa-list"></i> Player List</a>
            </div>
            <?php if (isset($custom_links) && !empty($custom_links)) { ?>
              <div class="list-group">
                <?php
                foreach ($custom_links as $key => $link) {
                  echo "<a href='" . $link . "' class='list-group-item'>" . $key . "</a>";
                }
                ?>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
    <!-- /Main Content -->

    <!-- Sidebar -->
    <div class="col-md-3 col-md-offset-1">

      <?php
      include "inc/serverstatusui.php";

      include 'inc/quicklinksui.php';
      ?>

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
