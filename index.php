<?php
define('LINKBASE', str_replace('index.php', '', $_SERVER['PHP_SELF']));

switch (strtolower($_GET['view'])) {
  case '' or 'index':
    include_once 'pages/front-page.php';
    break;

  case 'players':
    include_once 'pages/player.php';
    break;

  default:
    include_once 'pages/' . strtolower($_GET['view']) . '.php';
    break;
}
