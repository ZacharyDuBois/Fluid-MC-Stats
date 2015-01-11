<?php
/**
 * debug.php
 * Created for Fluid-MC-Stats.
 */

include_once APPPATH . 'config.php';

$output = array(
    'serverIP'          => $mc_server_ip,
    'serverPort'        => $mc_server_port,
    'serverName'        => $_SERVER['SERVER_NAME'],
    'requestURI'        => $_SERVER['REQUEST_URI'],
    'serverSoft'        => $_SERVER['SERVER_SOFTWARE'],
    'jsonEnabled'       => extension_loaded("json"),
    'cdnURI'            => $custom_hosted_uri,
    'baseURI'           => $base_URL,
    'avatarURI'         => $avatar_service_uri,
    'customLinks'       => $custom_links,
    'tmpDirExits'       => file_exists(APPPATH . 'tmp'),
    'tmpDirWrite'       => is_writable(APPPATH . 'tmp'),
    'configExits'       => file_exists(APPPATH . 'config.php'),
    'configWrite'       => is_writable(APPPATH . 'config.php'),
    'installExists'     => file_exists(APPPATH . 'pages/install/'),
    'topStatCalType'    => $player_top_calc_stat,
    'numberOfTopPlayer' => $player_on_top,

);

echo json_encode($output);
die();
