<?php
/**
 * File: Load.php
 * User: zacharydubois
 * Date: 2016-03-31
 * Time: 18:01
 * Project: Fluid-MC-Stats
 */

namespace fmcs;

// Array from which to load
$paths = array(
    'vendor/autoload.php',
    'inc',
    'controller'
);

// Run through and load everything.
foreach ($paths as $path) {
    $path = APP . $path;

    if (file_exists(APP . $path)) {
        require APP . $path;
    } else {
        throw new Exception("Cannot include non-existent file: " . $path);
    }
}
