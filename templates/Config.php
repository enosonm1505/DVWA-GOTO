<?php
namespace DVWA\Templates;

/**
 * Class Config
 * @package DVWA\Templates
 */
Class Config {
    protected $defaults = [];
    protected $defaults_location;
    protected $themeConfig = [];

    /**
     * The config constructor. Makes every property in the config file (written in JSON) a property of the Config class
     * instance.
     *
     * @param null $configPath The path to the config file to use.
     */
    public function __construct($configPath = null) {
        $this->defaults_location = dirname(__FILE__) . '/resources/themeDefaults.json';

        $this->defaults = (array) $this->getJsonContent($this->defaults_location, $this->defaults);

        if ($configPath !== null) {
            $this->themeConfig = (array) $this->getJsonContent($configPath, $this->themeConfig);
        }

        $configArray = array_merge($this->defaults, $this->themeConfig);

        // Add all config's properties to own element
        foreach ($configArray as $propertyKey => $propertyValue) {
            $this->$propertyKey = $propertyValue;
        }
    }

    public function __get($property = null) {
        if ($property !== null) {
            if (property_exists($this, $property)) {
                return $this->$property;
            } else {
                throw new \Exception('Couldn\'t find property ' . $property . ' in config.');
            }
        } else {

            // If no property is set, return the whole config
            return $this;
        }
    }

    public function __set($property, $value) {
        if (array_key_exists($property, $this->defaults)) {
            $this->$property = $value;
            return $this;
        } else {
            throw new \Exception('Property ' . $property . ' doesn\'t exist in config. Define it in ' . $this->defaults_location . '.');
        }
    }

    /**
     * Returns the config defaults in an Array;
     *
     * @return Object[] The config defaults.
     */
    public function getDefaults() {
        return $this->defaults;
    }

    /**
     * Returns the theme config in an Array;
     *
     * @return Object[] The user defined config.
     */
    public function getThemeConfig() {
        return $this->themeConfig;
    }

    /**
     * Get a file's contents and decode them from JSON.
     *
     * @param String $path The path to the file to decode.
     * @param mixed $default The default content to return when file could not be found.
     * @return mixed The parsed JSON from the given file.
     * @throws \Exception Throws an exception when reading the contents failed and no default was specified.
     */
    private function getJsonContent($path, $default = null) {
        $fileContents = false;
        $decodedContents = null;

        if (file_exists($path)) {
            $fileContents = file_get_contents($path);
            $decodedContents = json_decode($fileContents);
        }

        if (!$fileContents || $decodedContents === null) {
            if ($default === null) {
                if (!$fileContents) {
                    throw new \Exception('There was an error reading the contents from ' . $path .
                        ' and no default was specified (or was null).');
                } else if ($decodedContents === null) {
                    throw new \Exception('There was an error reading decoding the JSON from ' . $path .
                        ' and no default was specified (or was null).');
                }
            }
            return $default;
        }

        return $decodedContents;
    }
}