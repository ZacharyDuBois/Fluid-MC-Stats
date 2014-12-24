<?php
/**
 * Copyright (c) AccountProductions and Sybren Gjaltema, 2014. All rights reserved.
 */

include_once APPPATH . 'config.php';
include_once APPPATH . 'inc/status.php';

$status = new MinecraftServerStatus();
$r = $status->getStatus( $mc_server_ip, null, $mc_server_port);
?>
<div class="panel panel-danger">
  <div class="panel-heading">
    <h3 class="panel-title"><i class="fa fa-hdd-o"></i> Server Status</h3>
  </div>
  <div class="panel-body">
    <div>
      <img src="<?php if (!empty($mc_custom_icon)) {
        echo($mc_custom_icon);
      } elseif (!$r) {
        echo LINKBASE . "img/64.png";
      } else {
        echo $r['favicon'];
      } ?>" alt="<?php echo $server_name; ?>&apos;s Icon" class="img-circle server-sidebar-icon">
    </div>
    <hr>
    <p><strong>Name:</strong> <?php echo $server_name; ?></p>

    <p><strong>IP:</strong> <?php echo $mc_server_disp_addr; ?></p>

  </div>
</div>
