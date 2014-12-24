<?php
/**
 * Copyright (c) AccountProductions and Sybren Gjaltema, 2014. All rights reserved.
 */

include_once APPPATH . 'config.php';

/**
 * Discontinued because Minecraft-API is no-longer in service.
 */
//include_once 'serverstatus.php';

//$serverStatus = new serverstatus($mc_server_ip, $mc_server_port);
//$serverStatus->fetchServerData();
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
        echo LINKBASE . "img/64.png";
      } ?>" alt="<?php echo $server_name; ?>&apos;s Icon" class="img-circle server-sidebar-icon">
    </div>
    <hr>
    <p><strong>Name:</strong> <?php echo $server_name; ?></p>

    <p><strong>IP:</strong> <?php echo $mc_server_disp_addr; ?></p>

  </div>
</div>
