<?php
/**
 * Copyright (c) AccountProductions and Sybren Gjaltema, 2014. All rights reserved.
 */

// Check if config exists.
if (!file_exists(__DIR__ . '/../config.php')) {
  echo "<p style='color: #f00; padding: 20px;'>The configurations file is missing! Please reinstall or find the issue!</p>";
  die();
}
// Then include it.
include APPPATH.'config.php';

// Check if MySQL has been set and the install folder exists so we can redirect safely.
if ($mysql_host == '' && file_exists(__DIR__ . "/../pages/install/")) {
  $http = (isset($_SERVER['HTTPS']) ? 'https://' : 'http://');
  $installLoc = $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"] . "pages/install/install.php";
  $installLoc = str_replace('index.php', '', $installLoc);
  $installLoc = str_replace('//', '/', $installLoc);
  $installLoc = $http.$installLoc;
  header("Location: " . $installLoc);
  die();
}

// If MySQL is not set and install folder is missing, return an error.
if ($mysql_host == '') {
  echo "<p style='color: #f00; padding: 20px;'>Something is not right! The install folder is not in the normal location and the configurations file has not been correctly setup!</p>";
  die();
}

// If install exists, return an error.
if (file_exists(__DIR__ . "/../pages/install/")) {
  echo "<p style='color: #f00; padding: 20px;'>Oh No! The install folder still exists! Please remove the folder before continuing!</p>";
  die();
}
