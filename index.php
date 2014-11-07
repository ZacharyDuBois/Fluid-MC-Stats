<?php
include_once 'inc/link.php';

$base = str_replace('index.php', '', $_SERVER['PHP_SELF']);
if ($base === '') {
  $base = '/';

}
define('LINKBASE', $base);

$MENULINKS = array(
  new Link('Home', LINKBASE.'/', 'fa-home'),
  new Link('Server Stats', LINKBASE.'/server-stats', 'fa-hdd-o'),
  new Link('Top Lists', LINKBASE.'/top-lists', 'fa-bar-chart-o'),
  new Link('Top Players', LINKBASE.'/top-players', 'fa-bar-chart-o'),
  new Link('Player List', LINKBASE.'/player-list', 'fa-list'),
);

switch (strtolower($_GET['view'])) {
  case '':
    include_once 'pages/front-page.php';
    break;
  case 'index':
    include_once 'pages/front-page.php';
    break;

  case 'players':
    include_once 'pages/player.php';
    break;

  default:
    include_once 'pages/' . strtolower($_GET['view']) . '.php';
    break;
}
