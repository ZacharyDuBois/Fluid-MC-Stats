<?php
/**
 * status-cache.php
 * Created for Fluid-MC-Stats.
 */

include_once APPPATH . 'config.php';
include_once APPPATH . 'inc/status/MinecraftPing.php';
include_once APPPATH . 'inc/status/MinecraftPingException.php';
include_once APPPATH . 'inc/status/MinecraftQuery.php';
include_once APPPATH . 'inc/status/MinecraftQueryException.php';

use xPaw\MinecraftPing;
use xPaw\MinecraftPingException;
use xPaw\MinecraftQuery;
use xPaw\MinecraftQueryException;


$cacheFile = APPPATH . 'tmp/query.json';

// if the cache file exists.
if (file_exists($cacheFile)) {
  // check the file time.
  $creation_time = filemtime($cacheFile);
  if ((time() - $creation_time) >= 60) {
    // If file is older than 60 seconds, make a new query.
    unlink($cacheFile);
  }
}

if (!file_exists($cacheFile)) {

  /**
   * Run MinecraftQuery.php
   */

  // Start ping timer.
  $queryPing = microtime(true);

  $query = new MinecraftQuery();
  try {

    // Create connection.
    $query->Connect($mc_server_ip, $mc_server_port, 2);

  } catch (MinecraftQueryException $queryE) {
    $queryException = $queryE->getMessage();
  }

  // Stop ping and format to milliseconds.
  $queryPing = round((microtime(true) - $queryPing) * 1000);

  /**
   * Run MinecraftPing.php
   */

  // Start ping timer.
  $pingPing = microtime(true);

  try {
    $ping = new MinecraftPing($mc_server_ip, $mc_server_port, 2);

    $pingInfo = $ping->Query();

    if ($pingInfo === false) {

      // Old server
      $ping->Close();
      $ping->Connect();

      $pingInfo = $ping->QueryOldPre17();
    }
  } catch (MinecraftPingException $e) {
    $Exception = $e;
  }

  if ($ping !== null) {
    $ping->Close();
  }

  // Stop ping and format to milliseconds.
  $pingPing = round((microtime(true) - $pingPing) * 1000);

  // Store data.
  $rdata = array(
      'mcQuery'    => array(
          'getInfo'    => $query->GetInfo(),
          'getPlayers' => $query->GetPlayers(),
      ),
      'mcPing'     => array(
          'query' => $pingInfo,
      ),
      'pingTimes'  => array(
          'queryPing' => $queryPing,
          'pingPing'  => $pingPing,
          'avgPing'   => round((($queryPing + $pingPing) / 2), 0),
      ),
      'lastUpdate' => date("Y-m-d H:i:s"),
  );

  $fp = fopen($cacheFile, 'w');
  fwrite($fp, json_encode($rdata, JSON_PRETTY_PRINT));
  fclose($fp);
}

$data = json_decode(file_get_contents($cacheFile), true);
