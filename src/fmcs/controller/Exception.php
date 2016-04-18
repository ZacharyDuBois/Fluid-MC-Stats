<?php
/**
 * File: Exception.php
 * User: zacharydubois
 * Date: 2016-03-31
 * Time: 18:56
 * Project: Fluid-MC-Stats
 */

namespace fmcs;


/**
 * Class Exception
 *
 * Adds custom exception to improve security (by not displaying specific information) and implement custom output.
 *
 * @package fmcs
 */
class Exception extends \Exception {
    /**
     * Serve Message
     *
     * Provides details in a human readable format and prevents leakage of information through line numbers and files paths.
     * Provides additional information when DEBUG is set to true.
     *
     * @return string
     */
    public function serveMSG() {
        // Make sure the header is set to plain so it is easy to view in a browser.
        header('Content-Type: text/plain');

        // Set the exception details.
        $message = '``` Caught Exception' . PHP_EOL .
            'Error Code: ' . $this->getCode() . PHP_EOL .
            'Message: ' . $this->getMessage() . PHP_EOL .
            'VERSION: ' . VERSION . PHP_EOL;

        // If debug is enabled, provide more information.
        if (defined(DEBUG) && DEBUG === true) {
            $message .= 'Debug is enabled. Providing verbose exception information.' . PHP_EOL .
                'Caught In: ' . $this->getFile() . 'on line ' . $this->getLine() . PHP_EOL .
                'Caught On' . time() . PHP_EOL .
                '-- BEGIN STACKTRACE --' . PHP_EOL .
                $this->getTraceAsString() . PHP_EOL .
                '--  END STACKTRACE  --' . PHP_EOL;
        }

        // Add the trailing graves for markdown formatting.
        $message .= '```';

        // Return as string.
        return $message;
    }

}