<?php
/**
 * Copyright (c) AccountProductions and Sybren Gjaltema, 2014. All rights reserved.
 */

include_once APPPATH . 'config.php';
include_once APPPATH . 'inc/status-cache.php';
?>
<div class="panel panel-danger">
  <div class="panel-heading">
    <h3 class="panel-title"><i class="fa fa-hdd-o"></i> Server Status</h3>
  </div>
  <div class="panel-body">
    <div>
      <img src="<?php if (!empty($mc_custom_icon)) {
        echo($mc_custom_icon);
      } elseif ($offline == true) {
        echo LINKBASE . "img/64.png";
      } else {
        echo $data['favicon'];
      } ?>" alt="<?php echo $server_name; ?>&apos;s Icon" class="img-circle server-sidebar-icon">
    </div>
    <hr>

    <?php if ($offline == true) { ?>
      <h3 class="mc-offline"><i class="fa fa-times-circle-o"></i> Offline</h3>
      <p><strong>Name:</strong> <?php echo $server_name; ?></p>
      <p><strong>IP:</strong> <?php echo $mc_server_disp_addr; ?></p>
    <?php } else { ?>
      <h3 class="mc-online"><i class="fa fa-check"></i> Online
        <?php if ($data['ping'] >= 10) { ?>
          <small>(<?php echo $data['ping']; ?>ms)</small><?php } ?>
      </h3>
      <p><strong>Name:</strong> <?php echo $server_name; ?></p>
      <p><strong>IP:</strong> <?php echo $mc_server_disp_addr; ?></p>
      <p><strong><abbr title="Message Of The Day">MOTD</abbr>:</strong> <?php echo $data['motd']; ?></p>

      <p><strong>Version:</strong> <?php echo $data['version']; ?></p>
      <p><strong>Players:</strong> <?php echo $data['players'] . " of " . $data['maxplayers'] . " max"; ?></p>

      <div class="progress progress-striped active">
        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php
        $percentageFilled = $data['players'] / $data['maxplayers'] * 100;
        echo $percentageFilled;
        ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percentageFilled; ?>%">
          <span class="sr-only"><?php echo $percentageFilled; ?>% Complete</span>
        </div>
      </div>
    <?php } ?>

  </div>
</div>
