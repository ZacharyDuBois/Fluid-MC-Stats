<?php
/**
 * Copyright (c) AccountProductions and Sybren Gjaltema, 2014. All rights reserved.
 */
?>
<div class="panel panel-danger">
  <div class="panel-heading">
    <h3 class="panel-title"><i class="fa fa-link"></i> Quick Links</h3>
  </div>
  <div class="panel-body">
    <div class="list-group">
      <a href="<?php echo LINKBASE; ?>" title="Home" class="list-group-item<?php if ($navPage == "home") echo " active"; ?>"><i class="fa fa-home"></i> Home</a>
      <a href="<?php echo LINKBASE; ?>server-stats" title="Server Stats" class="list-group-item<?php if ($navPage == "server-stats") echo " active"; ?>"><i class="fa fa-hdd-o"></i> Server Stats</a>
      <a href="<?php echo LINKBASE; ?>top-lists" title="Top Lists" class="list-group-item<?php if ($navPage == "top-lists") echo " active"; ?>"><i class="fa fa-bar-chart-o"></i> Top Lists</a>
      <a href="<?php echo LINKBASE; ?>top-players" title="Top Players" class="list-group-item<?php if ($navPage == "top-players") echo " active"; ?>"><i class="fa fa-bar-chart-o"></i> Top Players</a>
      <a href="<?php echo LINKBASE; ?>player-list" title="Player List" class="list-group-item<?php if ($navPage == "player-list") echo " active"; ?>"><i class="fa fa-list"></i> Player List</a>
    </div>
    <div class="list-group">
      <?php
      foreach ($custom_links as $key => $link) {
        echo "<a href='" . $link . "' title='" . $key . "' class='list-group-item'>" . $key . "</a>";
      }
      ?>
    </div>
  </div>
</div>
