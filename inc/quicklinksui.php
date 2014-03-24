<?php
/**
 * Copyright (c) AccountProductions and Lolmewn 2014. All Rights Reserved.
 */
?>
<div class="panel panel-danger">
  <div class="panel-heading">
    <h3 class="panel-title"><i class="fa fa-link"></i> Quick Links</h3>
  </div>
  <div class="panel-body">
    <div class="list-group">
      <a href="<?php if ($navPage != "home") echo "../" ?>index.php" class="list-group-item<?php if ($navPage == "home") echo " active"; ?>"><i class="fa fa-home"></i> Home</a>
      <a href="<?php if ($navPage != "home") echo "../" ?>pages/server-stats.php" class="list-group-item<?php if ($navPage == "server-stats") echo " active"; ?>"><i class="fa fa-hdd-o"></i> Server Stats</a>
      <a href="<?php if ($navPage != "home") echo "../" ?>pages/top-players.php" class="list-group-item<?php if ($navPage == "top-players") echo " active"; ?>"><i class="fa fa-bar-chart-o"></i> Top Players</a>
      <a href="<?php if ($navPage != "home") echo "../" ?>pages/player-list.php" class="list-group-item<?php if ($navPage == "player-list") echo " active"; ?>"><i class="fa fa-list"></i> Player List</a>
    </div>
    <div class="list-group">
      <?php
      foreach ($custom_links as $key => $link) {
        echo "<a href='" . $link . "' class='list-group-item'>" . $key . "</a>";
      }
      ?>
    </div>
  </div>
</div>
