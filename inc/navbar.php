<?php
/**
 * Copyright (c) AccountProductions and Lolmewn 2014. All Rights Reserved.
 */
include_once '../config.php';
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

  <!-- Mobile -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="<?php if ($navPage != "home") echo "../" ?>index.php"><i class="fa <?php echo $fa_icon; ?>"></i> <?php echo $site_name; ?></a>
  </div>
  <!-- /Mobile -->

  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
      <li<?php if ($navPage == "home") echo " class='active'" ?>><a href="<?php if ($navPage != "home") echo "../" ?>index.php"><i class="fa fa-home"></i> Home</a></li>
      <li<?php if ($navPage == "server-stats") echo " class='active'" ?>><a href="<?php if ($navPage == "home") echo "pages/" ?>server-stats.php"><i class="fa fa-hdd-o"></i> Server Stats</a></li>
      <li<?php if ($navPage == "top-players") echo " class='active'" ?>><a href="<?php if ($navPage == "home") echo "pages/" ?>top-players.php"><i class="fa fa-bar-chart-o"></i> Top Players</a></li>
      <li<?php if ($navPage == "player-list") echo " class='active'" ?>><a href="<?php if ($navPage == "home") echo "pages/" ?>player-list.php"><i class="fa fa-list"></i> Player List</a></li>
    </ul>
    <form class="navbar-form navbar-right" role="search" action="<?php if ($navPage == "home") echo "pages/" ?>search.php">
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
