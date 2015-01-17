<?php
/**
 * debug.php
 * Created for Fluid-MC-Stats.
 */

include_once APPPATH . 'config.php';
include_once APPPATH . 'inc/version.php';

if (file_exists(APPPATH . 'tmp/query.json')) {
  $queryCache = json_decode(file_get_contents(APPPATH . 'tmp/query.json'), true);
} else {
  $queryCache = 'No Cache File';
}

$output = array(
    'serverInfo' => array(
        'phpVersion'    => PHP_VERSION,
        'webServer'     => $_SERVER['SERVER_SOFTWARE'],
        'os'            => PHP_OS,
        'serverName'    => $_SERVER['SERVER_NAME'],
        'requestURI'    => $_SERVER['REQUEST_URI'],
        'jsonEnabled'   => extension_loaded("json"),
        'mysqliEnabled' => extension_loaded("mysqli"),
    ),
    'configData' => array(
        'serverIP'           => $mc_server_ip,
        'serverPort'         => $mc_server_port,
        'cdnURI'             => $custom_hosted_uri,
        'baseURI'            => $base_URL,
        'avatarURI'          => $avatar_service_uri,
        'customLinks'        => $custom_links,
        'topStatCalType'     => $player_top_calc_stat,
        'numberOfTopPlayer'  => $player_on_top,
        'hideLimitedWarning' => $hide_limited_feature_warning,
        'mapURL'             => $map_url,
        'mapBg'              => $map_bg,
    ),
    'envInfo'    => array(
        'APPPATH'     => APPPATH,
        'LINKBASE'    => LINKBASE,
        'fmcsVersion' => $fmcs_version,
    ),
    'fileInfo'   => array(
        'tmpDirExits'          => file_exists(APPPATH . 'tmp'),
        'tmpDirWrite'          => is_writable(APPPATH . 'tmp'),
        'configExits'          => file_exists(APPPATH . 'config.php'),
        'configWrite'          => is_writable(APPPATH . 'config.php'),
        'installExists'        => file_exists(APPPATH . 'pages/install/'),
        'queryCacheFileExists' => file_exists(APPPATH . 'tmp/query.json'),
        'queryCacheFileWrite'  => is_writable(APPPATH . 'tmp/query.json'),
    ),
    'otherInfo'  => array(
        'queryData' => $queryCache,
    ),
);

header('Content-type: text/plain');

echo "YOU ARE IN DEBUG MODE! FLUID MC STATS WILL NOT FUNCTION WHEN IN THIS MODE!\n";

echo "Paste the following into your issue on GitHub:\n```json\n";
echo json_encode($output, JSON_PRETTY_PRINT);
echo "\n```";

die();
