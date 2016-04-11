<?php
/**
 * File: Load.php
 * User: zacharydubois
 * Date: 2016-03-31
 * Time: 18:01
 * Project: Fluid-MC-Stats
 */

namespace fmcs;

// Array of paths to load.
$load = array(
    'vendor/autoload.php',
    'controller'
);

// Iterate through and load each.
foreach ($load as $item) {
    $fullPath = APP . $item;

    // Check if it is a file or directory and load accordingly.
    switch ($fullPath) {
        case is_dir($fullPath):
            // If it is a directory, make sure to load all files inside it.
            foreach (glob($fullPath . '*.php') as $file) {
                require $file;
            }
            break;
        case is_file($fullPath):
            // If it is a normal file, just load normally.
            require $fullPath;
            break;
        default:
            // If it isn't either, throw and Exception.
            throw new Exception("Failed to require file '" . $item . "'", 1);
    }
}

// Make sure to unset variables.
unset($load);
unset($item);
unset($fullPath);
unset($file);
