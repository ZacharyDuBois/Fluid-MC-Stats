<?php

$base = str_replace('index.php', '', $_SERVER['PHP_SELF']);
if ($base === '') {
  $base == '/';

}
define('LINKBASE', $base);
var_dump(LINKBASE)

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
