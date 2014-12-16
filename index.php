<?php

define('APPPATH', dirname(__FILE__) . '/');

include_once APPPATH . 'inc/link.php';
include_once APPPATH . 'inc/security.php';
include_once APPPATH . 'config.php';

define('LINKBASE', '/' . $base_URL);


$MENULINKS = array(
    new Link(
        'Home',
        LINKBASE,
        'fa-home',
        'home'
    ),
    new Link(
        'Live Ticker',
        LINKBASE . 'live-ticker',
        'fa-bullhorn',
        'live-ticker'
    ),
    new Link(
        'Server Stats',
        LINKBASE . 'server-stats',
        'fa-hdd-o',
        'server-stats'
    ),
    new Link(
        'Top Lists',
        LINKBASE . 'top-lists',
        'fa-bar-chart-o',
        'top-lists'
    ),
    new Link(
        'Top Players',
        LINKBASE . 'top-players',
        'fa-bar-chart-o',
        'top-players'
    ),
    new Link(
        'Player List',
        LINKBASE . 'player-list',
        'fa-list',
        'player-list'
    ),
);

$view = '';
if (isset($_GET) === TRUE && isset($_GET['view']) === TRUE) {
  $view = $_GET['view'];
}

switch (strtolower($view)) {
  case '':
    include_once APPPATH . 'pages/front-page.php';
    break;

  case 'index':
    include_once APPPATH . 'pages/front-page.php';
    break;

  case 'players':
    include_once APPPATH . 'pages/player.php';
    break;

  default:
    include_once APPPATH . 'pages/' . strtolower($_GET['view']) . '.php';
    break;
}
