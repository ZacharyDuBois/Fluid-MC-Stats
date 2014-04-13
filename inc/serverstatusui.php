<?php
/**
 * Copyright (c) AccountProductions and Lolmewn 2014. All Rights Reserved.
 */

include_once '../config.php';
include_once 'serverstatus.php';

$serverStatus = new serverstatus($mc_server_ip, $mc_server_port);
$serverStatus->fetchServerData();
?>
<div class="panel panel-danger">
  <div class="panel-heading">
    <h3 class="panel-title"><i class="fa fa-hdd-o"></i> Server Status</h3>
  </div>
  <div class="panel-body">
    <div>
      <img src="<?php if (!empty($mc_custom_icon)) {
        echo($mc_custom_icon);
      } else {
        echo "http://minecraft-api.com/v1/logo/?server=" . $mc_server_ip . ":" . $mc_server_port;
      } ?>" alt="<?php echo $server_name; ?>&apos;s Icon" class="img-circle server-sidebar-icon">
    </div>
    <?php if ($serverStatus->isOnline() == true) { ?>
      <h3 class="mc-online"><i class="fa fa-check"></i> Online!</h3>
    <?php } elseif ($serverStatus->isDead() == true) { ?>
      <h3 class="mc-offline"><i class="fa fa-times-circle-o"></i> Offline</h3>
    <?php } else { ?>
      <h3 class="mc-unknown"><i class="fa fa-question-circle"></i> Unknown</h3>
    <?php
    }
    ?>
    <hr>
    <p><strong>Name:</strong> <?php echo $server_name; ?></p>

    <p><strong>IP:</strong> <?php echo $mc_server_disp_addr; ?></p>
    <?php if ($serverStatus->isOnline() == true) { ?>
      <p><strong>Players:</strong> <?php echo $serverStatus->getOnlinePlayerCount() . "/" . $serverStatus->getMaxPlayerCount(); ?></p>
    <?php } elseif ($serverStatus->isDead() == true) { ?>
      <p><strong>Players:</strong> ?/?</p>
    <?php
    } else {
      ?>
      <p><strong>Players:</strong> Unknown</p>
    <?php
    }
    ?>


    <div class="progress progress-striped active">
      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php
      $percentageFilled = 0;
      if ($serverStatus->isOnline() == true) {
        $percentageFilled = $serverStatus->getOnlinePlayerCount() / $serverStatus->getMaxPlayerCount() * 100;
      }
      echo $percentageFilled;
      ?>" aria-valuemin="0"
           aria-valuemax="100" style="width: <?php echo $percentageFilled; ?>%">
        <span class="sr-only"><?php echo $percentageFilled; ?>% Complete</span>
      </div>
    </div>
  </div>
</div>
