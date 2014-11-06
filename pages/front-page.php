<!DOCTYPE html>
<!--
  ~ Copyright (c) AccountProductions and Sybren Gjaltema, 2014. All rights reserved.
-->
<?php
/**
 * Copyright (c) AccountProductions and Sybren Gjaltema, 2014. All rights reserved.
 */

$navPage = "home";

include 'inc/security.php';
include 'config.php';
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

            <p>to the new Fluid MC Stats interface for the <?php echo $server_name; ?> server, powered by <a href="http://developgravity.com/">DevelopGravity</a> and <a
                  href="http://lolmewn.nl">Lolmewn</a>.</p>

            <p>Get started by searching for your stats on this server or...</p>

            <form role="search" action='<?php echo LINKBASE; ?>search'>
              <div class="input-group input-group-lg">
                <span class="input-group-addon"><i class="fa fa-user"></i></span> <input name='name' type="text" class="form-control" placeholder="Username">
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-default">
                    Find <i class="fa fa-chevron-right"></i>
                  </button>
                </span>
              </div>
            </form>
            <p>Explore...</p>

            <div class="list-group">
              <a href="<?php echo LINKBASE; ?>" title="Home" class="list-group-item active"><i class="fa fa-home"></i> Home</a>
              <a href="<?php echo LINKBASE; ?>server-stats" title="Server Statistics" class="list-group-item"><i class="fa fa-hdd-o"></i> Server Stats</a>
              <a href="<?php echo LINKBASE; ?>top-lists" title="Top Lists" class="list-group-item"><i class="fa fa-bar-chart-o"></i> Top Lists</a>
              <a href="<?php echo LINKBASE; ?>top-players" title="Top Players" class="list-group-item"><i class="fa fa-bar-chart-o"></i> Top Players</a>
              <a href="<?php echo LINKBASE; ?>player-list" title="Player List" class="list-group-item"><i class="fa fa-list"></i> Player List</a>
            </div>
            <?php if (isset($custom_links) && !empty($custom_links)) { ?>
              <div class="list-group">
                <?php
                foreach ($custom_links as $key => $link) {
                  echo "<a href='" . $link . "' title='" . $key . "' class='list-group-item'>" . $key . "</a>";
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
      include 'inc/serverstatusui.php';

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
