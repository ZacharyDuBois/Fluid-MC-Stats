<?php
/**
 * Copyright (c) AccountProductions and Lolmewn 2014. All Rights Reserved.
 */
// Check if config exists.
if (!file_exists('../config.php')) {
  echo "<p style='color: #f00; padding: 20px;'>The configurations file is missing! Please reinstall or find the issue!</p>";
  die();
}
// Then include it.
include '../config.php';

// Check if MySQL has been set and the install folder exists so we can redirect safely.
if ($mysql_host == '' && file_exists("../pages/install/")) {
  $http = ($_SERVER['HTTPS'] ? 'https://' : 'http://');
  $installLoc = $http . $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"] . "../pages/install/install.php";
  header("Location: " . $installLoc);
  die();
}

// If MySQL is not set and install folder is missing, return an error.
if ($mysql_host == '') {
  echo "<p style='color: #f00; padding: 20px;'>Something is not right! The install folder is not in the normal location and the configurations file has not been correctly setup!</p>";
  die();
}

// If install exists, return an error.
if (file_exists("pages/install/")) {
  echo "<p style='color: #f00; padding: 20px;'>Oh No! The install folder still exists! Please remove the folder before continuing!</p>";
  die();
}