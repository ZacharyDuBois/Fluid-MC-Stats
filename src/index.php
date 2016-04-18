<?php
/**
 * File: index.php
 * User: zacharydubois
 * Date: 2016-03-31
 * Time: 17:33
 * Project: Fluid-MC-Stats
 */

namespace fmcs;

// Enable debug.
define('DEBUG', false);

/////////////////////////////////////////////////////////////////////////
// Do not edit any of the following unless you know what you're doing. //
/////////////////////////////////////////////////////////////////////////

// Set version.
define('VERSION', '0.3.0');

// Shortcut directory separators.
define('DS', DIRECTORY_SEPARATOR);

// Define base path.
define('PATH', __DIR__ . DS);

// Define app path.
define('APP', PATH . DS . 'fmcs' . DS);

// Define storage
define('STORAGE', PATH . 'storage' . DS);

// Define temporary directory.
define('TMP', STORAGE . 'temporary' . DS);

// Load the stuffs!
require APP . 'inc' . DS . 'Run.php';
