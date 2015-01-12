<?php
/**
 * Copyright (c) AccountProductions and Sybren Gjaltema, 2014. All rights reserved.
 */

include_once APPPATH . 'config.php';
include_once APPPATH . 'inc/status-cache.php';

/**
 * Data
 */

$favicon = $data['mcPing']['query']['favicon'];
$motd = $data['mcPing']['query']['description'];
$mcVersion = $data['mcPing']['query']['version']['name'];
$curPlayers = $data['mcPing']['query']['players']['online'];
$maxPlayers = $data['mcPing']['query']['players']['max'];
$listPlayers = $data['mcQuery']['getPlayers'];

if ($limitedSupport == true) {
  $pingTime = $data['pingTimes']['pingPing'];
} else {
  $pingTime = $data['pingTimes']['avgPing'];
}
$lastUpdate = $data['lastUpdate'];
?>
<div class="panel panel-danger">
  <div class="panel-heading">
    <h3 class="panel-title"><i class="fa fa-hdd-o"></i> Server Status</h3>
  </div>
  <div class="panel-body">
    <div>
      <img src="<?php if (!empty($mc_custom_icon)) {
        echo($mc_custom_icon);
      } elseif ($isOffline == true) {
        echo LINKBASE . "img/64.png";
      }
      if ($favicon == null) {
        echo LINKBASE . "img/64.png";
      } else {
        echo $favicon;
      } ?>" alt="<?php echo $server_name; ?>&apos;s Icon" class="img-circle server-sidebar-icon">
    </div>
    <hr>

    <?php if ($isOffline == true) { ?>
      <h3 class="mc-offline"><i class="fa fa-times-circle-o"></i> Offline</h3>

      <p><strong>Name:</strong> <?php echo $server_name; ?></p>

      <p><strong>IP:</strong> <?php echo $mc_server_disp_addr; ?></p>
    <?php } else { ?>
      <h3 class="mc-online"><i class="fa fa-check"></i> Online
        <?php if ($pingTime >= 35) { ?>
          <small>(<?php echo $pingTime; ?>ms)</small><?php } ?>
      </h3>
      <p><strong>Name:</strong> <?php echo $server_name; ?></p>

      <p><strong>IP:</strong> <?php echo $mc_server_disp_addr; ?></p>

      <p><strong><abbr title="Message Of The Day">MOTD</abbr>:</strong> <?php echo $motd; ?></p>

      <p><strong>Version:</strong> <?php echo $mcVersion; ?></p>

      <p><strong>Players:</strong> <?php echo $curPlayers . " of " . $maxPlayers . " max"; ?></p>

      <div class="progress progress-striped active">
        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php
        $percentageFilled = (($curPlayers / $maxPlayers) * 100);
        echo $percentageFilled;
        ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percentageFilled; ?>%">
          <span class="sr-only"><?php echo $percentageFilled; ?>% Complete</span>
        </div>
      </div>
      <?php
      if ($listPlayers != false and $curPlayers != 0 and $limitedSupport == false) {
        $i = 0;
        ?>
        <div class="well well-sm">
          <?php
          foreach ($listPlayers as $player) { ?>
            <img class="img-circle avatar-list-icon" src="<?php echo $avatar_service_uri . $player . '/16' ?>">
            <?php
            $i++;
            if ($i == 15) {
              echo '...';
              break;
            }
          }
          ?>
        </div>
      <?php
      } elseif ($listPlayers == false and $curPlayers == 0 and $limitedSupport == false) { ?>
        <div class="well well-sm">
          <p>Looks like no one is online!</p>
        </div>
      <?php
      } elseif ($listPlayers == false and $limitedSupport == true and $hide_limited_feature_warning == false) { ?>
        <div class="well well-sm">
          <p>Oh no! <code>MinecraftQuery.php</code> cannot query your server. If you find this as an error, open an
             issue
             on GitHub. Otherwise, edit the config value <code>$hide_limited_feature_warning</code> to <code>true</code>.
          </p>
        </div>
      <?php
      }
    }
    ?>
  </div>
  <div class="panel-footer">
    <em>Last Query: <?php echo $lastUpdate; ?></em>
  </div>
</div>
