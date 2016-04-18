<?php
/**
 * File: Configuration.php
 * User: zacharydubois
 * Date: 2016-04-11
 * Time: 10:29
 * Project: Fluid-MC-Stats
 */

namespace fmcs;


class Configuration {
    /**
     * Holds path to configuration file
     */
    const file = 'configuration.json';

    /**
     * Holds current configuration data.
     *
     * @var array $config
     */
    private $config;

    /**
     * Holds new configuration data. Set when $this->set() is called.
     *
     * @var array $new
     */
    private $new;

    /**
     * Configuration constructor.
     *
     * Loads configuration when created.
     */
    public function __construct() {
        $this->reload();
    }

    /**
     * Reload Config
     *
     * Reloads the configuration from the disk.
     * Returns false when configuration doesn't exist.
     *
     * @return array|false
     * @throws Exception
     */
    public function reload() {
        // If configuration exists, load. If not, set false.
        if (file_exists(static::file)) {
            $this->config = json_decode(File::read(static::file), true);
        } else {
            $this->config = false;
        }

        return $this->config;
    }

    /**
     * Get Key
     *
     * Gets a configuration key from the loaded configuration.
     *
     * @param string $key
     * @return mixed
     */
    public function get(string $key) {
        // Check if key exists.
        if (key_exists($key, $this->config)) {
            return $this->config[$key];
        }

        return null;
    }

    /**
     * Set Key
     *
     * Sets a configuration key in the new array. Changes require $this->save() to be called.
     * Upon first call, it will load $this->new with the current configuration data.
     *
     * @param string $key
     * @param mixed $value
     * @return true
     */
    public function set(string $key, $value) {
        // If $this->new isn't set, make sure to set it.
        if (!isset($this->new)) {
            $this->new = $this->config;
        }

        // Edit the key/value in the new configuration data.
        $this->new[$key] = $value;

        return true;
    }

    /**
     * Save New Data
     *
     * Saves the new configuration to the disk and reloads the configuration array.
     *
     * @return true
     * @throws Exception
     */
    public function save() {
        // Make sure something changed.
        if (!isset($this->new)) {
            return false;
        }

        // Write changes.
        File::write(static::file, json_encode($this->new));

        // Reload configuration.
        $this->reload();

        return true;
    }
}