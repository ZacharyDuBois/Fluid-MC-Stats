<?php
/**
 * status-cache.php
 * Created for Fluid-MC-Stats.
 */

include_once APPPATH . 'config.php';
//include_once APPPATH . 'inc/status.php';

$cacheFile = APPPATH . 'tmp/query.json';
if (file_exists($cacheFile)) {
  $creation_time = filemtime($cacheFile);
  if ((time() - $creation_time) >= 60) {
    // If file is older than 60 seconds, make a new query.
    unlink($cacheFile);
  }
}

if (!file_exists($cacheFile)) {
  $status = new MinecraftServerStatus();
  $r = $status->getStatus($mc_server_ip, $mc_server_port);
  if (!$r) {
    $offline = true;
  } else {
    $offline = false;
    $rdata = array(
        'ping'       => $r['ping'],
        'version'    => $r['version'],
        'players'    => $r['players'],
        'maxplayers' => $r['maxplayers'],
        'motd'       => $r['motd'],
        'favicon'    => $r['favicon'],
        'lastupdate' => date("Y-m-d H:i:s"),
    );
    $fp = fopen($cacheFile, 'w');
    fwrite($fp, json_encode($rdata));
    fclose($fp);
  }
} else {
  $offline = false;
}

$data = json_decode(file_get_contents($cacheFile), true);