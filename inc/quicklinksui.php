<div class="panel panel-danger">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-link"></i> Quick Links</h3>
    </div>
    <div class="panel-body">
        <div class="list-group">
            <a href="../index.php" class="list-group-item<?php if($page == "home") echo " active";?>"><i class="fa fa-home"></i> Home</a>
            <a href="../pages/server-stats.php" class="list-group-item<?php if($page == "server-stats") echo " active";?>"><i class="fa fa-hdd-o"></i> Server Stats</a>
            <a href="../pages/top-players.php" class="list-group-item<?php if($page == "top-players") echo " active";?>"><i class="fa fa-bar-chart-o"></i> Top Players</a>
            <a href="../pages/player-list.php" class="list-group-item<?php if($page == "player-list") echo " active";?>"><i class="fa fa-list"></i> Player List</a>
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