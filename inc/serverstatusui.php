<?php
/**
 * Copyright (c) AccountProductions and Lolmewn 2014. All Rights Reserved.
 */

include_once __DIR__ . "/../config.php";
include_once __DIR__ . "/serverstatus.php";

$serverStatus = new serverstatus($mc_server_ip, $mc_server_port);
$serverStatus->fetchServerData();
?>
<div class="panel panel-danger">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-hdd-o"></i> Server Status</h3>
    </div>
    <div class="panel-body">
      <div>
        <img src="http://minecraft-api.com/v1/logo/?server=<?php echo $mc_server_ip; ?>:<?php echo $mc_server_port; ?>" alt="Server Icon" class="img-circle server-sidebar-icon">
      </div>
        <?php if ($serverStatus->isOnline()) { ?>
            <h3 class="mc-online"><i class="fa fa-check"></i> Online!</h3>
        <?php } else if ($serverStatus->isDead()) { ?>
            <h3 class="mc-unknown"><i class="fa fa-question-circle"></i> Unknown</h3>
        <?php } else { ?>
            <h3 class="mc-unknown"><i class="fa fa-frown-o"></i> Unknown</h3>
        <?php }
        ?>
        <hr>
        <p><strong>Name:</strong> <?php echo $server_name; ?></p>

        <p><strong>IP:</strong> <?php echo $mc_server_disp_addr; ?></p>
        <?php if ($serverStatus->isOnline()) { ?>
            <p><strong>Players:</strong> <?php echo $serverStatus->getOnlinePlayerCount() . "/" . $serverStatus->getMaxPlayerCount(); ?></p>
        <?php } else if ($serverStatus->isDead()) { ?>
            <p><strong>Players:</strong> ?/?</p>
        <?php }
        ?>


        <div class="progress progress-striped active">
            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php
            $percentageFilled = 0;
            if ($serverStatus->isOnline()) {
                $percentageFilled = $serverStatus->getOnlinePlayerCount() / $serverStatus->getMaxPlayerCount() * 100;
            }
            echo $percentageFilled;
            ?>" aria-valuemin="0"
                 aria-valuemax="100" style="width: <?php echo $percentageFilled; ?>%">
                <!-- TODO: Change value to reflect current online players -->
                <span class="sr-only"><?php echo $percentageFilled; ?>% Complete</span>
            </div>
        </div>
    </div>
</div>